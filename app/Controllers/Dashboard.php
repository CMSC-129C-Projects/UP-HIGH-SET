<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\SubjectModel;
use App\Models\EvalSheetModel;
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
    if (!$this->session->has('logged_user')) {
      return redirect()->to(base_url('login'));
    } elseif (!$_SESSION['logged_user']['emailVerified']) {
        return redirect()->to(base_url('verifyAccount'));
    }

    if ($_SESSION['logged_user']['role'] === '2') {
      return view('user_mgt/studentDashboard');
    } else {
      return view('user_mgt/dashboard');
    }
  }

  public function logout()
  {
    $this->session->remove('logged_user');
    $this->session->destroy();
    return redirect()->to(base_url('login'));
  }

  /*
  * Fetch all the subjects that have been evaluated successfully
  */
  public function fetch_evaluated_subjects() {

    $subjects_evaluated = [];

    $userModel = new UserModel();
    $subjectModel = new SubjectModel();
    $evalSheetModel = new EvalSheetModel();

    $subjects = $subjectModel->where('is_deleted', 0)->findAll();

    foreach ($subjects as $subject) {
      $student_count = $userModel->get_all_students_per_subject($subject['id']);

      if($student_count !== 0) {
        $students_who_evaluated = $evalSheetModel->get_all_students_who_evaluated($subject['id']);

        $percentage = ($students_who_evaluated / $student_count) * 100;

        if( $percentage === 100)
          array_push($subjects_evaluated, $subject['id']);
      }
    }

    return $subjects_evaluated;
  }

  /*
  * Calculate percentage of subjects completed / total subjects
  */
  public function get_subjects_stat() {
    $subjectModel = new SubjectModel();

    $subjects = $subjectModel->where('is_deleted', 0)->findAll();

    return round(count($this->fetch_evaluated_subjects()) / count($subjects) * 100, 2);
  }

  /*
  * Fetch evaluated subjects under a certain prof
  */

  // default choice is 1: get associative array (Prof: percentage of completion based on subjects evaluated),
  // 2: return number of professors that have been completely evaluated (all subjects handled have been evaluated)
  public function get_faculty_stat($choice = 1) {
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
}
