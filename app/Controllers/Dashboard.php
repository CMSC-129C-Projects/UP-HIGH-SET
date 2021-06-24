<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\SubjectModel;
use App\Models\EvalSheetModel;
use App\Models\EvaluationModel;
use App\Models\UserModel;
use App\Models\FacultyModel;


class Dashboard extends BaseController
{
  public function _remap($method)
  {
    switch($method)
    {
      case 'index':
      case 'logout':
        return $this->$method();
        break;
      default:
        return $this->index();
    }
  }

  public function index()
  {
    $css = ['custom/user_mgt/statistics.css'];
    $js = ['custom/statistics/statistics.js'];
    $data = [
        'js'    => addExternal($js, 'javascript'),
        'css'   => addExternal($css, 'css')
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

      $data['daysLeft'] = $daysLeft;
      $data['subject_stat'] = $subject_stat;
      $data['faculty_stat'] = $faculty_stat;
      $data['student_stat'] = $student_stat;
      $data['faculty_list'] = $subjectModel->get_final_rating();

      return view('user_mgt/dashboard', $data);
    }
  }

  public function logout()
  {
    $this->session->remove('logged_user');
    $this->session->destroy();
    return redirect()->to(base_url('login'));
  }

  /**
   * Get all information needed to display in frontend
   */
  protected function get_information()
  {
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
  public function fetch_evaluated_subjects()
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
  public function get_subjects_stat()
  {
    $subjectModel = new SubjectModel();

    $subjects = $subjectModel->where('is_deleted', 0)->findAll();

    $percentage = round((count($this->fetch_evaluated_subjects()) / count($subjects)) * 100, 2); 

    return [$percentage, count($subjects)];
  }

  /*
  * Fetch evaluated subjects under a certain prof
  */
  // default choice is 1: get associative array (Prof: percentage of completion based on subjects evaluated),
  // 2: return number of professors that have been completely evaluated (all subjects handled have been evaluated)
  public function get_faculty_stat($choice = 1)
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
  public function get_student_stat($choice = 1) {
    $subjectModel = new SubjectModel();
    $userModel = new UserModel();

    $students = $userModel->where('role', 2)->where('is_deleted', 0)->findAll();

    $student_done_evaluating = [];
    $students_in_progress = [];

    foreach ($students as $student) {
      $data = $subjectModel->get_in_progress_subjects_by_student($student->id);

      if(count($data) === 0)
        array_push($student_done_evaluating, $student);
      else
        array_push($students_in_progress, $student);
    }

    if($choice === 1)
      return [round((count($student_done_evaluating) / count($students)) * 100, 2),  count($students)];
    elseif($choice === 2)
      return $student_done_evaluating;
    else
      return $students_in_progress;
  }

  /*
  * Returns an associative array: Student Name => array of subjects in progress
  */
  public function get_subject_in_progress_by_student() {
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
}
