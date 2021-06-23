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
        // Do something
        $data = [
            'questions' => $this->get_questions()
        ];

        return view('linkofquestionsview', $data);
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

        foreach($questions as $question) {
            $separated_questions[$question['section_id']] = $question['question_text'];
        }

        return $separated_questions;
    }
}