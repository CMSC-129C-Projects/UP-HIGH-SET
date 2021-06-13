<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\SubjectModel;
use App\Models\EvalSheetModel;
use App\Models\UserModel;
use App\Models\EvaluationModel;


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
      $this->fetch_evaluated_subjects();
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

        echo $subject['id'] . "-" . $subject['name'] . " " . $student_count . " " . $students_who_evaluated . " " . $percentage . " | ";

        if( $percentage === 100)
          array_push($subjects_evaluated, $subject['name']);
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

    return count($this->fetch_evaluated_subjects()) / count($subjects);
  }


  /*
  * Fetch evaluated subjects under a certain prof
  */
  public function get_subjects_completed() {

  }

}
