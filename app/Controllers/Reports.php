<?php
namespace App\Controllers;

use \App\Entities\Admin;
use \App\Models\EvaluationModel;
use \App\Models\EvalSheetModel;
use \App\Models\EvalAnswersModel;
use \App\Models\UserModel;
use \App\Models\SectionModel;
use \App\Models\SubjectModel;
use \App\Models\FacultyModel;

class Reports extends BaseController
{
    protected $sections;

    public function _remap($method, $param1 = null)
    {
        $this->hasSession();
        $this->role_checking(['2', '3']);

        switch($method)
        {
            case 'report_per_subject':
                return $this->$method($param1);
                break;
            case 'report_per_faculty':
                return $this->$method($param1);
                break;
        }
    }

    function __construct() {
        $this->sections = [7 => 'Bartlett', 8 => 'Villamor', 9 => 'Benton', 10 => 'Palma', 11 => 'Bocobo', 12 => 'Sison'];
    }

    /**
     * View Progress Per Subject
     */
    public function report_per_subject($subject_id)
    {
        $userModel = new UserModel();
        $evaluationModel = new EvaluationModel();
        $subjectModel = new SubjectModel();
        $facultyModel = new FacultyModel();

        $data = [];

        $css = ['custom/reporting/profreport.min.css'];
        // $js = ['custom/monitor/piechart.js', 'custom/monitor/monitor.js'];
        $data = [
            'css' => addExternal($css, 'css'),
            // 'js'  => addExternal($js, 'javascript')
        ];

        // $results = [ratings, tally]
        $results = $this->compute_progress_per_subject($subject_id);
        $open_ended = $this->get_open_ended_per_sub($subject_id);
        $subject_info = $subjectModel->find($subject_id);
        $faculty_in_charge = $facultyModel->find($subject_info['faculty_id']);
        $evaluation_info = $evaluationModel->where('is_deleted', 0)->where('status', 'open')->first();


        $data['subject_info'] = $subject_info;
        $data['evaluation_info'] = $evaluation_info;
        $data['faculty'] = $faculty_in_charge;
        $data['ratings'] = $results[0];
        $data['tally'] = $results[1];
        $data['open_ended'] = $this->segregate_open_ended($open_ended);
        $data['sections'] = $this->sections;
        $data['total_students'] = $userModel->get_all_students_per_subject($subject_id);

        return view('reporting/subjectreport', $data);
    }

    /**
     * View all reports per faculty
     */
    public function report_per_faculty($faculty_id)
    {
        $evaluationModel = new EvaluationModel();
        $subjectModel = new SubjectModel();
        $facultyModel = new FacultyModel();

        $faculty_in_charge = $facultyModel->find($faculty_id);
        $subjects_handled = $subjectModel->get_subjects_by_faculty($faculty_id);

        // when displaying, loop through subjects_handled and use the subject id as a key
        // to check ratings of that subject in "all_ratings" variable
        $all_info = $this->get_all_info($subjects_handled);

        $css = ['custom/reporting/profreport.css'];
        $js = ['custom/reporting/print.min.js'];
        $data = [
            'css' => addExternal($css, 'css'),
            'js'  => addExternal($js, 'javascript'),
            'evaluation_info' => $evaluationModel->where('is_deleted', 0)->where('status', 'open')->first(),
            'faculty' => $faculty_in_charge,
            'all_info' => $all_info
        ];

        return view('reporting/profreport', $data);
    }

    /**
     * Group answers into strong points, weak points, and recommendations
     */
    protected function segregate_open_ended($open_ended)
    {
        $strongPoints = [];
        $weakPoints = [];
        $recommendations = [];
        foreach($open_ended as $user_answer) {
            foreach($user_answer as $answer) {
                switch($answer->question_id) {
                    case '37':
                        $strongPoints[] = $answer->answer_text;
                        break;
                    case '38':
                        $weakPoints[] = $answer->answer_text;
                        break;
                    case '39':
                        $recommendations[] = $answer->answer_text;
                        break;
                }
            }
        }
        return [$strongPoints, $weakPoints, $recommendations];
    }

    protected function get_open_ended_per_sub($subject_id)
    {
        $evalSheetModel = new EvalSheetModel();
        $evalAnswersModel = new EvalAnswersModel();

        $evalSheets = $evalSheetModel->collect_eval_sheets($subject_id);

        $all_open_ended = [];

        foreach($evalSheets as $evalSheet) {
            $open_ended = $evalAnswersModel->get_open_ended($evalSheet->id, $evalSheet->user_id);
            
            if ($open_ended)
                $all_open_ended[] = $open_ended;
        }
        return $all_open_ended;
    }

    /**
     * Get all ratings of subjetcs
     * including subject name, section and number of students
     */
    protected function get_all_info($subjects_handled)
    {
        $subjectModel = new SubjectModel();
        $userModel = new UserModel();

        $all_info = [];

        foreach($subjects_handled as $subject) {
            $rating = $this->compute_progress_per_subject($subject->id);

            $subject_info = $subjectModel->find($subject->id);
            
            $total_students = ($subjectModel->get_subjects_complete_count($subject->id))[0]->complete_count;

            $all_info[$subject->id] = [
                'subject_info' => $subject_info,
                'total_students' => $total_students,
                'rating' => $rating[0]
            ];
        }

        return $all_info;
    }

    /**
     * Get ratings of each subject
     * handled by the professor
     */
    protected function compute_progress_per_subject($subject_id)
    {
        $sectionModel = new SectionModel();
        $sections = $sectionModel->get_eval_sections_by_type(1);
        
        $evalSheetModel = new EvalSheetModel();
        $subjectModel = new SubjectModel();

        $size = ($subjectModel->get_subjects_complete_count($subject_id))[0]->complete_count;
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

        $this->store_rating($subject_id, $ratings[1]);

        return [$ratings, $tally];
    }
    
    /**
     * Update Subject Rating
     */
    protected function store_rating($subject_id, $rating)
    {
        $subjectModel = new SubjectModel();

        $final_rating = ['rating' => $rating];

        if (!$subjectModel->update($subject_id, $final_rating)) {
            return false;
        } else {
            return true;
        }
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
     * Segregate answers bsdrf on section id..
     * All answers will belong to the key which is the section id
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
     * AR: Average Rating
     * WR: Weighted Rating
     * FR: Final Rating
     * 
     * Compute Rating
     * Returns AR and WR, including FR
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
            if ($size == 0) {
                $ar = 0;
            } else {
                $ar = round($ar/($size*10), 4);
            }
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