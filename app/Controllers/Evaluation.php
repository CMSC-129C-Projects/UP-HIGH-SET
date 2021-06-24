<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\SectionModel;
use App\Models\EvalAnswersModel;
use App\Models\QuestionchoiceModel;
use App\Models\EvalSheetModel;
use App\Models\EvalquestionModel;
use App\Models\UserModel;
use App\Models\EvaluationModel;

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
      case 'submit':
        if ($_SESSION['logged_user']['role'] === '1' || $_SESSION['logged_user']['role'] === '3') // admin or clerk
          return redirect()->to(base_url('dashboard'));
        else
          return $this->$method($param1);
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
    $css = ['custom/evaluation/setstatus.css'];
    $js = ['custom/evaluation/setStatus.js'];
    $data = [
        'css' => addExternal($css, 'css'),
        'js'  => addExternal($js, 'javascript')
    ];

    return view('evaluation/setStatus', $data);
  }

  public function evaluate($eval_sheet_id = null)
  {
    $data = [];
    $data['status'] = null;

    if ($this->request->getMethod() === 'post') {
      // Create input type hidden for question type and question IDs of each question
      $questionIDs = $this->getQuestionIDs();
      $evaluationDetails = $this->getEvalDetails($questionIDs, $eval_sheet_id);
      if (!$this->saveDatabase($evaluationDetails[0], $evaluationDetails[1], $eval_sheet_id)) {
        $data['status'] = 'false';
      } else {
        $data['status'] = 'true';
      }
    }

    $css = ['custom/modalAddition.css', 'custom/alert.css', 'custom/evaluation/eval.css', 'custom/evaluation/submitModal.css'];
    $js = ['custom/alert.js', 'custom/evaluation/eval.js'];

    $items = $this->getAllItems();
    $prevAnswers = $this->getPreviousAnswers($eval_sheet_id);
    $numbers = $this->countAnswers($prevAnswers);

    $data['css'] = addExternal($css, 'css');
    $data['js'] = addExternal($js, 'javascript');
    $data['eval_sheet_id'] = $eval_sheet_id;
    $data['prevAnswers'] = $prevAnswers;
    $data['progress'] = $this->computeProgress($numbers[0], $numbers[1]);
    $data['questions'] = $items[0];
    $data['choices'] = $items[1];

    // $this->archive_evaluation();
    return view('evaluation/evaluate', $data);
  }

  public function submit($eval_sheet_id = null)
  {
    $data = [];
    $data['status'] = null;

    if ($this->request->getMethod() === 'post') {
      // Create input type hidden for question type and question IDs of each question
      $questionIDs = $this->getQuestionIDs(true);
      $evaluationDetails = $this->getEvalDetails($questionIDs, $eval_sheet_id, true);
      if (!$this->saveDatabase($evaluationDetails[0], $evaluationDetails[1], $eval_sheet_id, true)) {
        $data['status'] = 'false';
      } else {
        return redirect()->to(base_url('subjects/student_subjects'));
      }
    }

    $css = ['custom/modalAddition.css', 'custom/alert.css', 'custom/evaluation/eval.css', 'custom/evaluation/submitModal.css'];
    $js = ['custom/alert.js', 'custom/evaluation/eval.js'];

    $items = $this->getAllItems();
    $prevAnswers = $this->getPreviousAnswers($eval_sheet_id);
    $numbers = $this->countAnswers($prevAnswers);

    $data['css'] = addExternal($css, 'css');
    $data['js'] = addExternal($js, 'javascript');
    $data['eval_sheet_id'] = $eval_sheet_id;
    $data['prevAnswers'] = $prevAnswers;
    $data['progress'] = $this->computeProgress($numbers[0], $numbers[1]);
    $data['questions'] = $items[0];
    $data['choices'] = $items[1];

    return view('evaluation/evaluate', $data);
  }

  protected function countAnswers($prevAnswers)
  {
    $multipleChoiceTotal = 0;
    $openEndedTotal = 0;

    $numberOfQuestions = 0;

    foreach($prevAnswers as $answer) {
      if (strlen($answer['qChoice_id']) !== 0) {
        $multipleChoiceTotal += 1;
      }
      if (strlen($answer['answer_text']) !== 0) {
        $openEndedTotal += 1;
      }
      $numberOfQuestions += 1;
    }

    return [$multipleChoiceTotal + $openEndedTotal, $numberOfQuestions];
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
      // Get type of question
      $qType_id = $category['question_type_id'];
      // get choices and store in a list with the
      // category name as the key
      $choices[$category['name']] = $this->getChoices($qType_id);

      $result = $sectionModel->getQuestions($category['id']);
      $questions[$category['name']] = $result;
    }

    return [$questions, $choices];
  }

  /**
   * Get Previous Answers of user
   */
  protected function getPreviousAnswers($eval_sheet_id)
  {
    $evalAnswersModel = new EvalAnswersModel();
    $prevAnswers = $evalAnswersModel
      ->where('user_id', $_SESSION['logged_user']['id'])
      ->where('is_deleted', 0)
      ->where('eval_sheet_id', $eval_sheet_id)
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
  protected function getEvalDetails($questionIDs, $eval_sheet_id, $isSubmit = null)
  {
    $evaluationDetails = [];
    $numberOfAnswers = 0;
    foreach($questionIDs as $id) {

      if ($isSubmit) {
        $answerMultiple = $this->request->getPost('review_final_choices_' . $id);
        $answerComments = $this->request->getPost('review_answer_' . $id);
      } elseif (!$isSubmit) {
        $answerMultiple = $this->request->getPost('choices_' . $id);
        $answerComments = $this->request->getPost('answer_' . $id);
      }

      $details = [
        'user_id'       => $_SESSION['logged_user']['id'],
        'eval_sheet_id' => $eval_sheet_id,
        'question_id'   => $id,
        'qChoice_id'    => strlen($answerMultiple)!==0 ? $answerMultiple : null,
        'answer_text'   => strlen($answerComments)!==0 ? $answerComments : null,
        'status'        => 'save'
      ];

      if ($isSubmit) {
        $details['status'] = 'submit';
      }

      $evaluationDetails[] = $details;

      if (strlen($answerMultiple)!==0 || strlen($answerComments)!==0) {
        $numberOfAnswers++;
      }
    }

    $progress = $this->computeProgress($numberOfAnswers, count($questionIDs));
    $progress = number_format($progress, 0);

    return [$evaluationDetails, $progress];
  }

  /**
   * Call insert or update to save
   * answers to database
   */
  protected function saveDatabase($evaluationDetails, $progress, $eval_sheet_id, $isSubmit = false)
  {
    $evalAnswersModel = new EvalAnswersModel();
    $prevAnswers = $this->getPreviousAnswers($eval_sheet_id);
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

    if ($isSubmit) {
      $value = ['status' => 'Completed'];
    } elseif ($progress != 0) {
      $value = ['status' => 'Inprogress'];
    } else {
      $value = ['status' => 'Open'];
    }
    $evalsheetModel = new EvalSheetModel();
    if (!$evalsheetModel->update($eval_sheet_id, $value)) {
      return false;
    }

    return true;
  }

  /**
   * Computer progress of student
   */
  protected function computeProgress($numberOfAnswers, $size)
  {
    if ($size === 0) {
      return '0';
    }
    $progress = ($numberOfAnswers/$size)*100;
    return number_format($progress, 0);
  }

  /**
   * Get question IDs
   */
  protected function getQuestionIDs($isSubmit = null)
  {
    $questionIDs = [];
    $types = [];
    foreach ($_POST as $field => $value) {
        if ($isSubmit) {
          if (strpos($field, 'review_question_id_') === 0) {
            $questionIDs[] = $value;
          }
        } else {
          if (strpos($field, 'question_id_') === 0) {
            $questionIDs[] = $value;
          }
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

  public function submit_evaluation()
  {
    $evalModel = new EvaluationModel();

    $datum = ['status' => 'closed'];
    $evalModel->where('status', 'open')->set($datum)->update();
  }

  /*
  * Archive current evaluation: is_deleted = 0, thus when the evaluation is done and archived, evaluation papers will not be retrieved by the clerk
  */
  public function archive_evaluation()
  {
    $evaluationModel = new EvaluationModel();

    $data = $evaluationModel->get_latest_evaluation();

    if (count($data) !== 0) {
      $evaluationModel->archive_eval_sheet($data[0]->id);
      $evaluationModel->where('id', $data[0]->id)->where('is_deleted', 0)->set('is_deleted', 1)->update();
    }
  }
}
