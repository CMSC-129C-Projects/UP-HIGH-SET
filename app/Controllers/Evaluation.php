<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\SectionModel;
use App\Models\EvalAnswersModel;

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
    if ($this->request->getMethod() === 'post') {
      // Create input type hidden for question type and question IDs of each question
      $evaluationDetails = getEvalDetails($questionType, $size);
      if (!saveDatabase($evaluationDetail)) {
        $data['saveStatus'] = 'fail';
      } else {
        $data['saveStatus'] = 'success';
      }
    } else {
      $css = ['custom/modalAddition.css', 'custom/alert.css'];
      $js = ['custom/alert.js'];
  
      $data = [];
      $data['css'] = addExternal($css, 'css');
      $data['js'] = addExternal($js, 'javascript');
  
      $category = $sectionModel->where('is_deleted', 0)->select('name')->findAll();
      $categorySize = count($category);
  
      $questions = array();
      $sectionModel = new SectionModel();
  
      for($i = 1; $i < $categorySize+1; $i++) {
        $result = $sectionModel->getQuestions($i);
        $questions[] = $result;
      }
  
      $data = [
        'questions' => $questions,
      ];
  
      return view('evaluation/category', $data);
    }
  }

  protected function getEvalDetails($questionType, $size) {
    $evaluationDetail = [];
    $numberOfAnswers = 0;
    $answer = $this->request->getPost('choice' . $i);
    if (strlen($answer) === 0){
      $answer = null;
    } else {
      $numberOfAnswers++;
    }
    for($i=1; $i<=$size; $i++) {
      $evaluationDetails[] = [
        'user_id'     => $_SESSION['logged_user']['id'],
        'question_id' => $this->request->getPost('questionID' . $i),
        'qChoice_id'  => $answer,
        'status'      => 'save'
      ];
    }

    $progress = computeProgress($numberOfAnswers, $size);

    return $evaluationDetails;
  }

  protected saveDatabase($evaluationDetails) {
    $evalAnswersModel = new EvalAnswersModel();
    foreach($evaluationDetails as $detail) {
      if (!$evalAnswersModel->insert($detail)) {
        return false;
      }
    }
    return true;
  }

  protected function computeProgress($numberOfAnswers, $size)
  {
    $progress = ($numberOfAnswers/$size)*100;
    return $progress;
  }
}
