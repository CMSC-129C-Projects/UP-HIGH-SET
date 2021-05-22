<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\SectionModel;
use App\Models\EvalAnswersModel;
use App\Models\QuestionchoiceModel;
use App\Models\EvalSheetModel;
use App\Models\EvalquestionModel;

class Evaluation extends BaseController
{
  public function _remap($method, $param1=null)
  {
    if (!$this->session->has('logged_user')) {
      return redirect()->to(base_url('login'));
    } elseif (!$_SESSION['logged_user']['emailVerified']) {
      return redirect()->to(base_url('verifyAccount'));
    }
    switch ($method)
    {
      case 'set_status':
        if ($_SESSION['logged_user']['role'] === '2')
          return redirect()->to(base_url('dashboard'));
        else
          return $this->$method();
      case 'getUnfinished':
        if ($_SESSION['logged_user']['role'] === '2')
          return redirect()->to(base_url('dashboard'));
        else
          return $this->$method($param1);
        break;
      case 'evaluate':
      case 'index':
        if ($_SESSION['logged_user']['role'] === '1')
          return redirect()->to(base_url('dashboard'));
        else
          return $this->evaluate($param1);
      }
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

  /**
   * Get questions with its choices
   */
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
      ->select('id, qChoice_id, answer_text')
      ->findAll();

    return $prevAnswers;
  }

  /**
   * get choices from the database
   */
  protected function getChoices($q_type_id)
  {
    $qChoiceModel = new QuestionchoiceModel();

    $choices = $qChoiceModel->where('q_type_id', $q_type_id)->where('is_deleted', 0)->select('id, choice')->findAll();
    return $choices;
  }

  /**
   * Get details from input that
   * should be sent to database
   */
  protected function getEvalDetails($questionIDs)
  {
    $evaluationDetail = [];
    $numberOfAnswers = 0;
    foreach($questionIDs as $id) {
      $answerMultiple = $this->request->getPost('choices_' . $id);
      $answerComments = $this->request->getPost('answer_' . $id);

      $evaluationDetails[] = [
        'user_id'     => $_SESSION['logged_user']['id'],
        'question_id' => $id,
        'qChoice_id'  => strlen($answerMultiple)!==0 ? $answerMultiple : null,
        'answer_text' => strlen($answerComments)!==0 ? $answerComments : null,
        'status'      => 'save'
      ];
    }

    $progress = $this->computeProgress($numberOfAnswers, count($questionIDs));

    return $evaluationDetails;
  }

  /**
   * Call insert or update to save
   * answers to database
   */
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

  /**
   * Computer progress of student
   */
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
    $types = [];
    foreach ($_POST as $field => $value) {
        if (strpos($field, 'question_id_') === 0) {
          $questionIDs[] = $value;
        }
    }
    return $questionIDs;
  }

  protected function notifyStudents()
  {
    $emailModel = new EmailModel();

    $emailContent = $emailModel->where('is_deleted', '0')->where('purpose', 'announcement')->orderBy('created_on', 'desc')->first();

    //alert user that his/her account's password changed if you did not do it blahblah --
    $search = ['-content-', '-student-', '-website_link-'];
    $subject = $emailContent['title'];

    $message = file_get_contents(base_url() . '/app/Views/announcement.html');
		$replace = [$emailContent['message'], $_SESSION['logged_user']['name'], base_url()]; //redirect to login page

		$message = str_replace($search, $replace, $message);
		$status = send_acc_notice($_SESSION['logged_user']['email'], $subject, $message);
  }

  /**
   * Fetch students not yet finished evaluation a subject
   */
  public function getUnfinished($subjectID)
  {
    $evalsheetModel = new EvalSheetModel();
    $evalAnswersModel = new EvalAnswersModel();
    $evalQuestionModel = new EvalquestionModel();

    $size = $evalQuestionModel->getNumberOfQuestions();

    $size = $size[0]->size;

    $sheets = $evalsheetModel->getUnfinishedStudents($subjectID);

    $progress = [];

    foreach($sheets as $sheet) {
      $studentAnswers = $evalAnswersModel->getNotNull($sheet->id);
      $progress[] = [
        'student_id' => $sheet->student_id,
        'progress' => sprintf('%.0f', $this->computeProgress($studentAnswers[0]->answersTotal, $size))
      ];
    }

    echo json_encode($progress);
  }
}
