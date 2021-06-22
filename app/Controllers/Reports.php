<?php
namespace App\Controllers;

use \App\Entities\Admin;
use \App\Models\EvalSheetModel;
use \App\Models\EvalAnswersModel;
use \App\Models\UserModel;
use \App\Models\SectionModel;

class Reports extends BaseController
{
    public function index() {
        $css = ['custom/monitor/monitor.css'];
        $js = ['custom/monitor/piechart.js', 'custom/monitor/monitor.js'];
        $data = [
            'css' => addExternal($css, 'css'),
            'js'  => addExternal($js, 'javascript')
        ];
        return view('monitor/monitor', $data);
    }

    /**
     * View Progress Per Subject
     */
    public function progress_per_subject($subject_id)
    {
        $sectionModel = new SectionModel();
        $sections = $sectionModel->get_eval_sections_by_type(1);
        
        $evalSheetModel = new EvalSheetModel();
        $userModel = new UserModel();

        $size = $userModel->get_all_students_per_subject($subject_id);
        $evalSheets = $evalSheetModel->collect_eval_sheets($subject_id);        

        // Section ID serves as the key
        foreach($sections as $section) {
            $tally[$section->id] = [
                'e'  => 0,
                'vg' => 0,
                'g'  => 0,
                'f'  => 0,
                'p'  => 0
            ];
        }

        foreach($evalSheets as $evalSheet) {
            $answers = $this->get_answers_per_sheet($evalSheet->id, $evalSheet->user_id);

            $tally = $this->tally_answers($answers, $tally);
        }

        $ratings = $this->compute_rating($tally, $size);

        echo json_encode($ratings);
    }

    /**
     * Get Open Ended Questions
     * and Answers
     */
    protected function get_open_ended($evalSheet)
    {
        $evalAnswersModel = new EvalAnswersModel();

        return $evalAnswersModel->get_open_ended($evalsheetID, $user_id);
    }

    /**
     * Get Answers Per Sheet
     */
    protected function get_answers_per_sheet($evalsheetID, $user_id)
    {
        $evalAnswersModel = new EvalAnswersModel();

        return $evalAnswersModel->get_answers_per_sheet($evalsheetID, $user_id);
    }

    /**
     * Segregate answers
     */
    protected function tally_answers($answers, $tally)
    {
        foreach($answers as $answer) {
            // General evaluation will not
            // be recorded because of using
            // switch statement
            switch($answer->qChoice_id) {
                case 1:
                    $tally[$answer->section_id]['e'] += 1;
                    break;
                case 2:
                    $tally[$answer->section_id]['vg'] += 1;
                    break;
                case 3:
                    $tally[$answer->section_id]['g'] += 1;
                    break;
                case 4:
                    $tally[$answer->section_id]['f'] += 1;
                    break;
                case 5:
                    $tally[$answer->section_id]['p'] += 1;
                    break;
                default:
            }
        }
        return $tally;
    }

    /** 
     * Compute Rating
    */
    protected function compute_rating($tally, $size)
    {
        $sectionWeights = [0.7, 0.2, 0.05, 0.05];
        // Formula
        $ar = 0;
        $results = [];
        $fr = 0;

        foreach($tally as $section => $values) {
            $ar = ($values['e'] * 1) + ($values['vg'] * 2) + ($values['g'] * 3) + ($values['f'] * 4) + ($values['p'] * 5);
            $ar = round($ar/($size*10), 4);
            $wr = round($ar * $sectionWeights[$section-1], 4);

            $fr += $wr;

            $results[$section] = [
                'AR' => number_format($ar, 4),
                'WR' => number_format($wr, 4)
            ];
        }
        return [$results, number_format($fr, 4)];
    }
}