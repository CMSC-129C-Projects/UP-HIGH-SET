<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\SubjectModel;
use App\Models\EvalSheetModel;
use App\Models\UserModel;
use App\Models\FacultyModel;
use App\Models\SectionModel;


class Questions extends BaseController
{
    // public function _remap()
    // {

    // }

    public function index()
    {
        // Do something
    }

    protected function get_questions()
    {
        $sectionModel = new SectionModel();

        $questions = [];
        $categoryIDs = $sectionModel->get_ids();

        return $questions;
    }
}