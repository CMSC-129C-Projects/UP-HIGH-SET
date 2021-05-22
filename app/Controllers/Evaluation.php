<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\SectionModel;
use App\Models\UserModel;
use App\Models\EvalSheetModel;

class Evaluation extends BaseController
{
  public function index() {
    if (!$this->session->has('logged_user')) {
      return redirect()->to(base_url('login'));
    } elseif (!$_SESSION['logged_user']['emailVerified']) {
      return redirect()->to(base_url('verifyAccount'));
    }

    return redirect()->to(base_url('category'));
  }

  public function set_status() {
    return view('evaluation/setStatus');
  }

  public function set_category($evalSheetId = null) {
    $css = ['custom/modalAddition.css', 'custom/alert.css'];
    $js = ['custom/alert.js'];

    $data = [];
    $data['css'] = addExternal($css, 'css');
    $data['js'] = addExternal($js, 'javascript');

    $sectionModel = new SectionModel();
    $category = $sectionModel->where('is_deleted', 0)->select('name')->findAll();
    $categorySize = count($category);

    $questions = array();

    $db = \Config\Database::connect();

    for($i = 1; $i < $categorySize+1; $i++) {

      $sql = <<<EOT
SELECT eval_section.name, eval_question.question_text
FROM eval_section
LEFT JOIN eval_question ON eval_question.section_id = eval_section.id
WHERE eval_question.is_deleted = 0 and eval_question.section_id = $i
ORDER BY eval_question.question_order ASC
EOT;

  $query = $db->query($sql);
  $result = $query->getResult();

  $questions[] = $result;
  }

  $data = [
    'questions' => $questions,
  ];

    $this->get_progress_by_subject();

    return view('evaluation/category', $data);
  }

  public function get_progress_by_subject($subject_id = null) {
    if(isset($subject_id)) {
      $userModel = new UserModel();
      $evalSheetModel = new EvalSheetModel();

      $students_per_subjects =  $userModel->get_all_students_per_subject($subject_id);
      $student_who_evaluated = $evalSheetModel->get_all_students_who_evaluated($subject_id);

      $percentage = ($student_who_evaluated / $students_per_subjects) * 100;

      return $percentage;
    } else {
      return false;
    }
  }
}
