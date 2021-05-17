<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\SectionModel;
use App\Models\EvalAnswersModel;
use App\Models\QuestionchoiceModel;

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

  public function evaluate($evalSheetId = null)
  {
    if ($this->request->getMethod() === 'post') {
      // Create input type hidden for question type and question IDs of each question
      $evaluationDetails = $this->getEvalDetails($questionType, $size);
      if (!$this->saveDatabase($evaluationDetail)) {
        $data['saveStatus'] = 'fail';
      } else {
        $data['saveStatus'] = 'success';
      }
    } else {
      $css = ['custom/modalAddition.css', 'custom/alert.css', 'custom/evaluation/eval.css'];
      $js = ['custom/alert.js', 'custom/evaluation/eval.js'];
  
      $data = [];
      $data['css'] = addExternal($css, 'css');
      $data['js'] = addExternal($js, 'javascript');
  
      $items = $this->getAllItems();
      $data['questions'] = $items[0];
      $data['choices'] = $items[1];
  
      return view('evaluation/evaluate', $data);
    }
  }

  protected function getAllItems()
  {
    $sectionModel = new SectionModel();

    $categories = $sectionModel->where('is_deleted', 0)->select('id, name, question_type_id')->findAll();

    $questions = array();

    foreach($categories as $category) {
      $qType_id = $category['question_type_id'];
      $choices[$category['name']] = $this->getChoices($qType_id);

      $result = $sectionModel->getQuestions($category['id']);
      $questions[$category['name']] = $result;
    }

    return [$questions, $choices];
  }

  protected function getChoices($q_type_id)
  {
    $qChoiceModel = new QuestionchoiceModel();

    $choices = $qChoiceModel->where('q_type_id', $q_type_id)->where('is_deleted', 0)->select('id, choice')->findAll();
    return $choices;
  }

  protected function getEvalDetails($questionType, $size) {
    $evaluationDetail = [];
    $numberOfAnswers = 0;
    for($i=1; $i<=$size; $i++) {
      $answer = $this->request->getPost('choice' . $i);
      if (strlen($answer) === 0){
        $answer = null;
      } else {
        $numberOfAnswers++;
      }

      $evaluationDetails[] = [
        'user_id'     => $_SESSION['logged_user']['id'],
        'question_id' => $this->request->getPost('questionID' . $i),
        'qChoice_id'  => $answer,
        'status'      => 'save'
      ];
    }

    $progress = $this->computeProgress($numberOfAnswers, $size);

    return $evaluationDetails;
  }

  protected function saveDatabase($evaluationDetails) {
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
