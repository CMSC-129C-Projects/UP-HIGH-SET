<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\SectionModel;
use App\Models\SubjectModel;
use App\Models\EvalSheetModel;
use App\Models\EvaluationModel;
use App\Models\UserModel;
use App\Models\FacultyModel;


class Dashboard extends BaseController
{
  public function _remap($method, $param1 = null)
  {
    $this->hasSession(0);

    switch($method)
    {
      case 'index':
        return $this->$method($param1);
        break;
      case 'logout':
        return $this->$method();
        break;
      default:
        return $this->index();
    }
  }

  public function index($notif = null)
  {
    $css = ['custom/user_mgt/statistics.css', 'custom/alert.css'];
    $js = ['custom/statistics/statistics.js'];
    $data = [
        'js'    => addExternal($js, 'javascript'),
        'css'   => addExternal($css, 'css'),
        'notif' => $notif
    ];

    if (!$this->session->has('logged_user')) {
      return redirect()->to(base_url('login'));
    } elseif (!$_SESSION['logged_user']['emailVerified']) {
        return redirect()->to(base_url('verifyAccount'));
    }

    if ($_SESSION['logged_user']['role'] === '2') {
      return view('user_mgt/studentDashboard');
    } else {
      $subjectModel = new SubjectModel();

      [$daysLeft, $subject_stat, $faculty_stat, $student_stat] = $this->get_information();

      if (!$this->is_open_eval()) {
        $student_stat[0] = 0;
      }

      $data['daysLeft'] = $daysLeft;
      $data['subject_stat'] = $subject_stat;
      $data['faculty_stat'] = $this->get_faculty_percentage($faculty_stat);
      $data['student_stat'] = $student_stat;
      $data['faculty_list'] = $subjectModel->get_final_rating();

      return view('user_mgt/dashboard', $data);
    }
  }

  protected function is_open_eval()
  {
    $evaluationModel = new EvaluationModel();

    $eval_info = $evaluationModel->where('is_deleted', 0)->where('status', 'open')->first();

    return isset($eval_info) && count($eval_info) !== 0;
  }

  public function logout()
  {
    $this->session->remove('logged_user');
    $this->session->destroy();
    return redirect()->to(base_url('login'));
  }

  protected function get_faculty_percentage($faculty_stat)
  {
    $completed_count = 0;

    foreach($faculty_stat as $key => $value) {
      if ($value == 100) {
        $completed_count++;
      }
    }

    if (count($faculty_stat) === 0) {
      $percentage = 0;
    } else {
      $percentage = round(($completed_count/ count($faculty_stat)) * 100, 2);
    }
    return [$percentage, count($faculty_stat)];
  }

  /**
   * Get all information needed to display in frontend
   */
  protected function get_information()
  {
    $this->compute_ratings();
    $daysLeft = $this->compute_days_left();
    $subject_stat = $this->get_subjects_stat();
    $faculty_stat = $this->get_faculty_stat(1);
    $student_stat = $this->get_student_stat();

    return [$daysLeft, $subject_stat, $faculty_stat, $student_stat];
  }

  protected function compute_days_left()
  {
    // Get Evaluation info (i.e. days left, status, etc.) [start]
    $evaluationModel = new EvaluationModel();

    $evaluation_info = $evaluationModel->where('is_deleted', 0)
                                    ->where('status', 'open')->first();

    $data['evaluation_info'] = $evaluation_info;

    if (isset($evaluation_info)) {
      $datetime1 = date_create(date('Y-m-d H:i:s'));
      $datetime2 = date_create($evaluation_info['date_end']);

      $interval = date_diff($datetime2, $datetime1);

      $timeLeft = $this->add_leading_zeros($interval->format('%H:%i:%s'));

      // Convert to days difference
      $daysLeft = $interval->format('%a');

      return $daysLeft;
    }
    // Get Evaluation info (i.e. days left, status, etc.) [end]
  }

  /*
  * Fetch all the subjects that have been evaluated successfully
  */
  protected function fetch_evaluated_subjects()
  {
    $subjects_evaluated = [];

    $userModel = new UserModel();
    $subjectModel = new SubjectModel();
    $evalSheetModel = new EvalSheetModel();

    $subjects = $subjectModel->where('is_deleted', 0)->findAll();

    foreach ($subjects as $subject) {
      $student_count = $userModel->get_all_students_per_subject($subject['id']);

      if($student_count !== 0) {
        $students_who_evaluated = $evalSheetModel->get_all_students_who_evaluated($subject['id']);

        if ($student_count != 0) {
          $percentage = ($students_who_evaluated / $student_count) * 100;
        } else {
          $percentage = 0;
        }

        if( $percentage === 100)
          array_push($subjects_evaluated, $subject['id']);
      }
    }

    return $subjects_evaluated;
  }

  /*
  * Calculate percentage of subjects completed / total subjects
  */
  protected function get_subjects_stat()
  {
    $subjectModel = new SubjectModel();

    $subjects = $subjectModel->where('is_deleted', 0)->findAll();

    if (count($subjects) === 0) {
      $percentage = 0;
    } else {
      $percentage = round((count($this->fetch_evaluated_subjects()) / count($subjects)) * 100, 2);
    }

    return [$percentage, count($subjects)];
  }

  /*
  * Fetch evaluated subjects under a certain prof
  */
  // default choice is 1: get associative array (Prof: percentage of completion based on subjects evaluated),
  // 2: return number of professors that have been completely evaluated (all subjects handled have been evaluated)
  protected function get_faculty_stat($choice = 1)
  {
    $facultyModel = new FacultyModel();

    $faculties = $facultyModel->where('is_deleted', 0)->findAll();
    $evaluated_subject_ids = $this->fetch_evaluated_subjects(); // returns completed subject ids

    $subjects_per_faculty = [];
    $keys = []; // array of keys
    $values = []; // array of values
    $count_matched_subjects = 0;

    // fetch subjects per faculty
    foreach ($faculties as $faculty) {
      array_push($subjects_per_faculty, $facultyModel->get_subjects_handled($faculty['id']));
    }

    // check whether any of the subjects handled by each prof belongs to the completely evaluated subjects
    foreach ($subjects_per_faculty as $subject) {
      foreach ($subject as $subj) {
        if(!in_array($subj->faculty_name, $keys)) {
          array_push($keys, $subj->faculty_name);
        }

        if(in_array($subj->id, $evaluated_subject_ids)) { // checks whether the subject id of the subjects handled by the professor matched those that are already evaluated
          $count_matched_subjects++;
        }
      }
       // an associative array for Prof -> percentage of completion (subjects evaluated / total subjects handled)
      if(count($subject) > 0)
        array_push($values, ($count_matched_subjects / count($subject)) * 100);

      $count_matched_subjects = 0;
    }

    if($choice === 1) {
      $faculty_subject_stats = array_combine($keys, $values);

      return $faculty_subject_stats;
    } else {
      $faculty_evaluated_count = 0;

      foreach ($values as $percentage) {
        if($percentage === 100)
          $faculty_evaluated_count++;
      }

      return $faculty_evaluated_count; // number of faculties that have 100% evaluated subjects
    }
  }

  /*
  * Get Students statistics
  */
  // choice 1: percentage (student done evaluating / total students) [DEFAULT]
  // choice 2: array of students done evaluating (student object from database)
  // choice 3: array of students still evaluating  or will have to evaluate with  their details (first name, last name and id)
  protected function get_student_stat($choice = 1) {
    $subjectModel = new SubjectModel();
    $userModel = new UserModel();

    $students = $userModel->where('role', 2)->where('is_deleted', 0)->findAll();

    $student_done_evaluating = [];
    $students_in_progress = [];

    foreach ($students as $student) {
      $data = $subjectModel->get_in_progress_subjects_by_student($student->id);

      // echo json_encode($data);
      if(count($data) === 0)
        array_push($student_done_evaluating, $student);
      else
        array_push($students_in_progress, $student);
    }

    if($choice === 1) {
      if (count($students) === 0) {
        $percentage = 0;
      } else {
        $percentage = round((count($student_done_evaluating) / count($students)) * 100, 2);
      }
      return [$percentage, count($students)];
    } elseif($choice === 2)
      return $student_done_evaluating;
    else
      return $students_in_progress;
  }

  /*
  * Returns an associative array: Student Name => array of subjects in progress
  */
  protected function get_subject_in_progress_by_student() {
    $subjectModel = new SubjectModel();
    $keys = [];
    $values = [];

    $students_still_evaluating = $this->get_student_stat(3);

    foreach ($students_still_evaluating as $student) {
        array_push($keys, ($student->first_name . " " . $student->last_name));
        array_push($values, $subjectModel->get_in_progress_subjects_by_student($student->id));
    }

    return $student_subjects_inprog = array_combine($keys, $values);
  }

  protected function add_leading_zeros($timeLeft)
  {
    $times = explode(':', $timeLeft);

    return $times[0] . ':' . ((strlen($times[1]) == 1) ? ('0' . $times[1]) : $times[1]) . ':' . ((strlen($times[2]) == 1) ? ('0' . $times[2]) : $times[2]);
  }

  protected function get_order()
  {
    $facultyModel = new FacultyModel();
    
    $facultyList = $facultyModel->where('is_deleted', 0)->orderBy('rating', 'asc')->findAll();

    return $facultyList;
  }

  protected function compute_ratings()
  {
    $subjectModel = new SubjectModel();

    $subjects = $subjectModel->where('is_deleted', 0)->findAll();

    if (isset($subjects)) {
      foreach($subjects as $subject) {
        $this->compute_progress_per_subject($subject['id']);
      }
    }
  }

  /**
   * Get ratings of each subject
   * handled by the professor
   */
  protected function compute_progress_per_subject($subject_id)
  {
      $sectionModel = new SectionModel();
      $sections = $sectionModel->get_eval_sections_by_type(1);
      
      $evalSheetModel = new EvalSheetModel();
      $subjectModel = new SubjectModel();

      $size = ($subjectModel->get_subjects_complete_count($subject_id))[0]->complete_count;
      $evalSheets = $evalSheetModel->collect_eval_sheets($subject_id);

      // Section ID serves as the key
      foreach($sections as $section) {
          $tally[$section->id] = [
              'e'  => 0,
              'vg' => 0,
              'g'  => 0,
              'f'  => 0,
              'p'  => 0
          ];
      }

      foreach($evalSheets as $evalSheet) {
          $answers = $this->get_answers_per_sheet($evalSheet->id, $evalSheet->user_id);

          $tally = $this->tally_answers($answers, $tally);
      }

      $ratings = $this->compute_rating($tally, $size);

      $this->store_rating($subject_id, $ratings[1]);

      return [$ratings, $tally];
  }
  
  /**
   * Update Subject Rating
   */
  protected function store_rating($subject_id, $rating)
  {
      $subjectModel = new SubjectModel();

      $final_rating = ['rating' => $rating];

      if (!$subjectModel->update($subject_id, $final_rating)) {
          return false;
      } else {
          return true;
      }
  }
  
  /**
   * Get Answers Per Sheet
   */
  protected function get_answers_per_sheet($evalsheetID, $user_id)
  {
      $evalAnswersModel = new EvalAnswersModel();

      return $evalAnswersModel->get_answers_per_sheet($evalsheetID, $user_id);
  }

  /**
   * Segregate answers bsdrf on section id..
   * All answers will belong to the key which is the section id
   */
  protected function tally_answers($answers, $tally)
  {
      foreach($answers as $answer) {
          // General evaluation will not
          // be recorded because of using
          // switch statement
          switch($answer->qChoice_id) {
              case 1:
                  $tally[$answer->section_id]['e'] += 1;
                  break;
              case 2:
                  $tally[$answer->section_id]['vg'] += 1;
                  break;
              case 3:
                  $tally[$answer->section_id]['g'] += 1;
                  break;
              case 4:
                  $tally[$answer->section_id]['f'] += 1;
                  break;
              case 5:
                  $tally[$answer->section_id]['p'] += 1;
                  break;
              default:
          }
      }
      return $tally;
  }

  /** 
   * AR: Average Rating
   * WR: Weighted Rating
   * FR: Final Rating
   * 
   * Compute Rating
   * Returns AR and WR, including FR
  */
  protected function compute_rating($tally, $size)
  {
      $sectionWeights = [0.7, 0.2, 0.05, 0.05];
      // Formula
      $ar = 0;
      $results = [];
      $fr = 0;

      foreach($tally as $section => $values) {
          $ar = ($values['e'] * 1) + ($values['vg'] * 2) + ($values['g'] * 3) + ($values['f'] * 4) + ($values['p'] * 5);
          if ($size == 0) {
              $ar = 0;
          } else {
              $ar = round($ar/($size*10), 4);
          }
          $wr = round($ar * $sectionWeights[$section-1], 4);

          $fr += $wr;

          $results[$section] = [
              'AR' => number_format($ar, 4),
              'WR' => number_format($wr, 4)
          ];
      }
      return [$results, number_format($fr, 4)];
  }
}
