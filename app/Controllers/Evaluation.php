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
    return view('evaluation/setStatus');
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

    return view('evaluation/evaluate', $data);
  }

  public function submit($eval_sheet_id = null)
  {
    $data = [];

    if ($this->request->getMethod() === 'post') {
      // Create input type hidden for question type and question IDs of each question
      $questionIDs = $this->getQuestionIDs(true);
      $evaluationDetails = $this->getEvalDetails($questionIDs, $eval_sheet_id, true);
      if (!$this->saveDatabase($evaluationDetails[0], $evaluationDetails[1], $eval_sheet_id)) {
        $data['saveStatus'] = 'fail';
      } else {
        $data['saveStatus'] = 'success';

        // $this->emailCarbonCopy($eval_sheet_id);
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
  protected function saveDatabase($evaluationDetails, $progress, $eval_sheet_id)
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

    if ($progress == 100) {
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

  public function submit_evaluation() {
    $evalModel = new EvaluationModel();

    $datum = ['status' => 'closed'];
    $evalModel->where('status', 'open')->set($datum)->update();

    $this->emailCardbonCopy();
  }

  protected function createCarbonCopy($eval_sheet_id)
  {
    $items = $this->getAllItems();
    $prevAnswers = $this->getPreviousAnswers($eval_sheet_id);
    $numbers = $this->countAnswers($prevAnswers);

    $progress = $this->computeProgress($numbers[0], $numbers[1]);
    $questions = $items[0];
    $choices = $items[1];
    $index = 0;

    $content = '';

    foreach($questions as $key => $value) {
      $content .= '<div class="row" style="background-color:#7b1113;">
                      <p style="font-size: 19px; color: #e9dbc1; padding-left:10px; padding-top:5px; padding-bottom:5px; margin-top:3px; margin-bottom: 3px;">' . $key . '</p>
                  </div>';
      foreach($value as $q) {
        $content .=   '<div class="row" style="margin-top: 3px;">
                        <div class="col-12" style="margin-top: 3px;">
                          <p style="font-size: 15px; color: #7b1113; padding-top: 3px;">' . $q->question_text . '</p>
                        </div>
                      </div>
                      <div class="row">';
        if ($key === 'Comments') {
          $content .= '<div class="col-12" style="margin-top: 3px;">
                        <textarea class="form-control" style="font-size: 13px; width:536px; border-color: #7b1113; border-width: 3px;" rows="6" readonly>' . $prevAnswers ? $prevAnswers[$index]['answer_text']: '' . '</textarea>
                      </div>
                      </div>';
        } else {
          $content .= '<div class="col-12" style="text-align:center;">
                        <li style="display:inline;">
                          <i style="font-size: 14px;"> Excellent </i>
                        </li>';
          foreach($choices[$key] as $choice) {
            $content .= '<li style="display:inline;">';
            if(count($prevAnswers) != 0 && $prevAnswers[$index]['qChoice_id'] === $choice['id']) {
              $content .= '<input type="radio" name="review_choices_' . $q->id . '" value="' . $choice['id'] . '" checked="checked" disabled>';
            } else {
              $content .= '<input type="radio" name="review_choices_' . $q->id . '" value="' . $choice['id'] . '" disabled>';
            }
            $content .= '</li>';
          }

          $content .= '<li style="display:inline;">
                          <i style="font-size: 14px;"> Poor </i>
                        </li>';
        }
        $content .= '</div></div>';
        $index++;
      }
      $content .= '<br>';
    }
    $content = $this->sanitize_output($content);
    return $content;
  }

  protected function emailCarbonCopy($evalSheetId = null) {
    if(isset($evalSheetId)) {
      $evalsheetModel = new EvalSheetModel();
      $details = $evalsheetModel->get_eval_sheet_dets($evalSheetId);

      $search = ['-professor-', '-subject-', '-content-'];
      $subject = "Copy of Evaluation " . $evalSheetId;

      $message = file_get_contents(base_url() . '/app/Views/email/evalCarbonCopy.html');
  		$replace = [$details[0]->prof, $details[0]->subject, $this->createCarbonCopy($evalSheetId)]; //redirect to login page

  		$message = str_replace($search, $replace, $message);
  		$status = send_acc_notice($_SESSION['logged_user']['email'], $subject, $message);
      return $status;
    }
  }
}
