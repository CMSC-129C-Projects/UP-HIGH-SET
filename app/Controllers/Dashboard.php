<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\SubjectModel;
use App\Models\EvalSheetModel;
use App\Models\UserModel;


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
      $this->fetch_evaluated_subjects();
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
      $student_total_count = $userModel->get_all_students_per_subject($subject['id']);

      if($student_total_count > 0) {
        $student_who_evaluated_count = $evalSheetModel->get_all_students_who_evaluated($subject['id']);

        $progress = ($student_who_evaluated_count / $student_total_count) * 100;

        echo $subject['name'] . " " . $student_total_count . " " . $student_who_evaluated_count . " " . $progress . " | ";

        if( $progress === 100)
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

  
}
