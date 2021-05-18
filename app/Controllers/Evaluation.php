<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\SectionModel;
use App\Models\EvalAnswersModel;
use App\Models\QuestionchoiceModel;

class Evaluation extends BaseController
{
  public function index()
  {
    if (!$this->session->has('logged_user')) {
      return redirect()->to(base_url('login'));
    } elseif (!$_SESSION['logged_user']['emailVerified']) {
      return redirect()->to(base_url('verifyAccount'));
    }

    return redirect()->to(base_url('category'));
  }

  public function set_status()
  {
    return view('evaluation/setStatus');
  }

  public function evaluate($evalSheetId = null)
  {
    if ($this->request->getMethod() === 'post') {
      // Create input type hidden for question type and question IDs of each question
      $questionIDs = $this->getQuestionIDs();
      $evaluationDetails = $this->getEvalDetails($questionIDs);
      if (!$this->saveDatabase($evaluationDetails)) {
        $data['saveStatus'] = 'fail';
      } else {
        $data['saveStatus'] = 'success';
      }
    }

    $css = ['custom/modalAddition.css', 'custom/alert.css', 'custom/evaluation/eval.css'];
    $js = ['custom/alert.js', 'custom/evaluation/eval.js'];

    $data = [];
    $data['css'] = addExternal($css, 'css');
    $data['js'] = addExternal($js, 'javascript');

    $items = $this->getAllItems();
    $data['prevAnswers'] = $this->getPreviousAnswers();
    $data['questions'] = $items[0];
    $data['choices'] = $items[1];

    return view('evaluation/evaluate', $data);
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

  /**
   * Get Previous Answers of user
   */
  protected function getPreviousAnswers()
  {
    $evalAnswersModel = new EvalAnswersModel();
    $prevAnswers = $evalAnswersModel
      ->where('user_id', $_SESSION['logged_user']['id'])
      ->where('is_deleted', 0)
      ->select('id, qChoice_id')
      ->findAll();

    return $prevAnswers;
  }

  protected function getChoices($q_type_id)
  {
    $qChoiceModel = new QuestionchoiceModel();

    $choices = $qChoiceModel->where('q_type_id', $q_type_id)->where('is_deleted', 0)->select('id, choice')->findAll();
    return $choices;
  }

  protected function getEvalDetails($questionIDs)
  {
    $evaluationDetail = [];
    $numberOfAnswers = 0;
    foreach($questionIDs as $id) {
      $answer = $this->request->getPost('choices_' . $id);
      if (strlen($answer) === 0){
        $answer = null;
      } else {
        $numberOfAnswers++;
      }

      $evaluationDetails[] = [
        'user_id'     => $_SESSION['logged_user']['id'],
        'question_id' => $id,
        'qChoice_id'  => $answer,
        'status'      => 'save'
      ];
    }

    $progress = $this->computeProgress($numberOfAnswers, count($questionIDs));

    return $evaluationDetails;
  }

  protected function saveDatabase($evaluationDetails)
  {
    $evalAnswersModel = new EvalAnswersModel();
    $prevAnswers = $this->getPreviousAnswers();
    if (count($prevAnswers) === 0) {
      foreach($evaluationDetails as $detail) {
        if (!$evalAnswersModel->insert($detail)) {
          return false;
        }
      }
    } else {
      $index = 0;
      foreach($evaluationDetails as $detail) {
        if (!$evalAnswersModel->update($prevAnswers[$index]['id'], $detail)) {
          return false;
        }
        $index++;
      }
    }
    
    return true;
  }

  protected function computeProgress($numberOfAnswers, $size)
  {
    $progress = ($numberOfAnswers/$size)*100;
    return $progress;
  }

  /**
   * Get question IDs
   */
  protected function getQuestionIDs()
  {
    $questionIDs = [];
    foreach ($_POST as $field => $value) {
        if (strpos($field, 'question_id_') === 0) {
            $questionIDs[] = $value;
        }
    }
    return $questionIDs; 
  }
}
