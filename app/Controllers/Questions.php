<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\SubjectModel;
use App\Models\EvalSheetModel;
use App\Models\UserModel;
use App\Models\FacultyModel;
use App\Models\SectionModel;
use App\Models\EvalquestionModel;


class Questions extends BaseController
{
    // public function _remap()
    // {

    // }

    public function index()
    {
        $sectionModel = new SectionModel();

        $data = [];
        $data['status'] = null;

        if ($this->request->getMethod() === 'post') {
            if (!$this->save_questions()) {
                $data['status'] = 'false';
            } else {
                $data['status'] = true;
            }
        }

        // $css = ['custom/modalAddition.css', 'custom/alert.css', 'custom/evaluation/eval.css', 'custom/evaluation/submitModal.css'];
        $css = ['custom/alert.css', 'custom/evaluation/eval.css'];
        $js = ['custom/alert.js', 'custom/evaluation/questions.js'];

        $data['css'] = addExternal($css, 'css');
        $data['js'] = addExternal($js, 'javascript');
        $data['questions'] = $this->get_questions();
        $data['sections'] = $sectionModel->where('is_deleted', 0)->findAll();

        return view('evaluation/updateQuestions', $data);
    }

    protected function save_questions()
    {
        $db = \Config\Database::connect();
        $db->transBegin();
        
        $questionModel = new EvalquestionModel();
        $questionIDs = $this->get_ids();

        foreach($questionIDs as $id) {
            $values = [
                'section_id' =>  $this->request->getPost('section_' . $id),
                'question_text' => $this->request->getPost('question' . $id)
            ];

            if (!strpos($id, 'new')) {
                $questionModel->update($id, $values);
            } else {
                $questionModel->insert($values);
            }
        }

        if ($db->transStatus() === FALSE) {
            $db->transRollback();
            return false;
        } else {
            $db->transCommit();
            return true;
        }
    }

    protected function get_ids()
    {
        $ids = [];

        foreach ($_POST as $field => $value) {
            if (strpos($field, 'question_id_') === 0) {
                $ids[] = $value;
            }
        }

        return $ids;
    }

    public function delete_question($question_id)
    {
        $questionModel = new EvalquestionModel();

        if (!$questionModel->update($question_id, ['is_deleted' => 1])) {
            $response = ['message' => 'failed'];
        } else {
            $response = ['message' => 'success'];
        }

        echo json_encode($response);
    }

    protected function get_questions()
    {
        $sectionModel = new SectionModel();
        $questionModel = new EvalquestionModel();

        $questions = [];
        // $categoryIDs = $sectionModel->get_ids();
        $questions = $questionModel->where('is_deleted', 0)->findAll();


        return $this->segregate_questions($questions);
    }

    protected function segregate_questions($questions)
    {
        $separated_questions = [];

        $section1 = []; $section2 = []; $section3 = [];
        $section4 = []; $section5 = []; $section6 = [];

        foreach($questions as $question) {
            switch($question['section_id']) {
                case '1':
                    $section1[] = [
                        'id' => $question['id'],
                        'content' => $question['question_text']
                    ];
                    break;
                case '2':
                    $section2[] = [
                        'id' => $question['id'],
                        'content' => $question['question_text']
                    ];
                    break;
                case '3':
                    $section3[] = [
                        'id' => $question['id'],
                        'content' => $question['question_text']
                    ];
                    break;
                case '4':
                    $section4[] = [
                        'id' => $question['id'],
                        'content' => $question['question_text']
                    ];
                    break;
                case '5':
                    $section5[] = [
                        'id' => $question['id'],
                        'content' => $question['question_text']
                    ];
                    break;
                case '6':
                    $section6[] = [
                        'id' => $question['id'],
                        'content' => $question['question_text']
                    ];
                    break;
            }
        }
        $separated_questions['1'] = $section1;
        $separated_questions['2'] = $section2;
        $separated_questions['3'] = $section3;
        $separated_questions['4'] = $section4;
        $separated_questions['5'] = $section5;
        $separated_questions['6'] = $section6;

        return $separated_questions;
    }
}