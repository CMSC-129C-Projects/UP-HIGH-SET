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
use App\Models\SubjectModel;
use App\Models\FacultyModel;

class Monitoring extends BaseController
{
    public function _remap($method, $param1 = null)
    {
        $this->hasSession();
        $this->role_checking(['2']);

        switch($method) {
            case 'monitor_progress':
            case 'update_set_status':
                return $this->$method();
                break;
            case 'get_subjects':
                $this->$method($param1);
                break;
            case 'transcend_students':
            case 'count_sheet_per_status_per_subject':
                $this->$method();
                break;
            default:
                return redirect()->to(base_url('dashboard'));
        }
    }

    /*
    * Moving Up: Increment Student's Grade Level
    */
    public function transcend_students()
    {
        $userModel = new UserModel();

        $data = [
            'grade_level' => NULL,
            'is_active' => 0,
            'is_deleted' => 1
        ];

        $userModel->where('role', 2)->where('is_active', 1)->where('is_deleted', 0)->where('grade_level', 12)->set($data)->update();

        $userModel->update_grade_level(11, 12);
        $userModel->update_grade_level(10, 11);
        $userModel->update_grade_level(9, 10);
        $userModel->update_grade_level(8, 9);
        $userModel->update_grade_level(7, 8);

        return redirect()->to(base_url('dashboard'));
    }

    /**
     * Monitor progress of subjects
     */
    public function monitor_progress()
    {
        $css = ['custom/monitor/monitor.css'];
        $js = ['custom/monitor/piechart.js', 'custom/monitor/monitor.js'];

        $faculModel = new FacultyModel();

        $data = [
            'css'   => addExternal($css, 'css'),
            'js'    => addExternal($js, 'javascript'),
            'profs' => $faculModel->findAll()
        ];

        return view('monitor/monitor', $data);
    }

    /**
     * Changing set status to open or close
     */
    public function update_set_status()
    {
        $data['validation'] = null;
        $data['db_content'] = null;
        $data['status'] = null;

        if (!$this->hasEnrolledStudents()) {
            $data['db_content'] = 'false';
        } else {
            if($this->request->getMethod() == 'post') {
                if($this->validate($this->get_rules())) {
                    if (!$this->open_SET()) {
                        $data['status'] = 'false';
                    } else {
                        $data['status'] = 'true';
                    }
                } else {
                    $data['validation'] = $this->validator;
                }
            }
        }

        $css = ['custom/evaluation/setstatus.css', 'custom/alert.css'];
        $js = ['custom/evaluation/setStatus.js', 'custom/alert.js'];
        $data['css'] = addExternal($css, 'css');
        $data['js']  = addExternal($js, 'javascript');

        return view('evaluation/setStatus', $data);
    }

    protected function hasEnrolledStudents()
    {
        $userModel = new UserModel();

        $students = $userModel->where('is_deleted', 0)
                              ->where('is_active', 1)
                              ->where('role', 2)
                              ->findAll();

        return count($students) !== 0;
    }

    protected function get_rules()
    {
        $rules = [
            'type' => 'required',
            'nth-type' => 'required',
            'dateStart' => [
                'rules'  => 'required|correctDateFormat',
                'errors' => [
                    'correctDateFormat' => 'Date format should by Y-m-d'
                ]
            ],
            'dateEnd' => [
                'rules'  => 'required|correctDateFormat',
                'errors' => [
                    'correctDateFormat' => 'Date format should by Y-m-d'
                ]
            ],
        ];
        return $rules;
    }

    /**
     * Close SET period
     */
    protected function close_SET()
    {
        $evaluationModel = new EvaluationModel();

        // this assumes that in every period, there is only one 
        // open evaluation entry
        $currentEvaluation = $evaluationModel
                            ->where('is_deleted', 0)
                            ->where('status', 'open')
                            ->first();

        $value = ['status' => 'closed'];
        $where = ['id' => $currentEvaluation->id];

        return $evaluationModel->update($where, $value) ? true: false;
    }

    /**
     * Open SET period
     */
    protected function open_SET()
    {
        $db = \Config\Database::connect();
        $db->transBegin();

        $evaluationModel = new EvaluationModel();

        $date_start = explode('-', $this->request->getPost('dateStart'));

        $values = [
            'status' => 'open',
            'date_start' => $this->request->getPost('dateStart'),
            'date_end' => $this->request->getPost('dateEnd'),
            'year_start' => $date_start[0],
            'year_end' => $date_start[0] + 1
        ];

        $type = $this->request->getPost('type');

        if ($type === 'semester') {
            $values['semester'] = $this->request->getPost('nth-type');
        } elseif ($type === 'grading') {
            $values['grading'] = $this->request->getPost('nth-type');
        }

        $evaluationIDs = $evaluationModel->select('id')->findAll();

        $evaluationModel->update($this->convert_to_list($evaluationIDs), ['status' => 'closed', 'is_deleted' => 1]);

        $evaluationModel->insert($values);
        $evaluation_id = $evaluationModel->getInsertID();

        $this->generate_eval_sheets($evaluation_id);

        if ($db->transStatus() === FALSE) {
            $db->transRollback();
            return false;
        } else {
            $db->transCommit();
            return true;
        }
    }

    protected function convert_to_list($evaluationIDs)
    {
        $idList = [];

        foreach($evaluationIDs as $id) {
            $idList[] = $id['id'];
        }
        return $idList;
    }

    /**
     * Every opening of set status, eval sheets will be
     * given to each student
     */
    protected function generate_eval_sheets($evaluation_id)
    { 
        $userModel = new UserModel();
        $evalSheetModel = new EvalSheetModel();

        $all_subjects = $this->get_subjects_per_gradelevel();

        $students = $userModel->asArray()
                        ->where('role', 2)
                        ->where('is_active', 1)
                        ->where('is_deleted', 0)
                        ->findAll();
        
        foreach($students as $student) {
            foreach($all_subjects[$student['grade_level']] as $subject) {
                $values = [
                    'evaluation_id' => $evaluation_id,
                    'student_id' => $student['id'],
                    'subject_id' => $subject->id,
                    'verified' => false,
                    'rating' => 0,
                    'status' => 'Open'
                ];

                if (!$evalSheetModel->insert($values)) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Get all subjects and store in an array (key-value pair)
     * where gradelevel will serve as the key
     */
    protected function get_subjects_per_gradelevel()
    {
        $gLevels = [7,8,9,10,11,12];
        $allSubjects = [];

        $subjectModel = new SubjectModel();

        foreach($gLevels as $gLevel) {
            $allSubjects[$gLevel] = $subjectModel->get_subjects_by_gradelevel($gLevel);
        }

        return $allSubjects;
    }

    /**
     * Get Subjects per Faculty
     */
    public function get_subjects($faculty_id)
    {
        $subjectModel = new SubjectModel();
        if(!$subjects = $subjectModel->get_subjects_by_faculty($faculty_id)) {
            $response = [
                'is_available' => 0,
                'message'      => 'Subjects not found.'
            ];
        } else {
            $subjectsWithProgress = [];
            foreach($subjects as $subject) {
                $subject->progress = $this->get_progress_by_subject($subject->id);

                $unfinished = $this->getUnfinished($subject->id);

                $subject->studentsNotDone = $this->createAccordion($unfinished);
                $subject->numNotDone = count($unfinished);

            }

            $response = [
                'is_available' => 1,
                'message'      => 'Subjects found.',
                'subjects'     => $subjects
            ];
        }
        echo json_encode($response);
    }

    /**
     * Get Count of eval_sheet per status
     * Per subject
     */
    public function count_sheet_per_status_per_subject()
    {
        $evalSheetModel = new EvalSheetModel();

        if (!$statuses = $evalSheetModel->count_perStatus_perSubject()) {
            $response = [
                'is_available' => 0,
                'message' => 'An error has occurred.'
            ];
        } else {
            $response = [
                'is_available' => 1,
                'statuses' => $statuses
            ];
        }
        echo json_encode($response);
    }

    /**
     * Create Accordion for students
     * Not yet done answering
     */
    protected function createAccordion($studentsNotDone)
    {
        if (isset($studentsNotDone)) {
            $accordion = '<button class="accordion">Incomplete Evaluations</button><div class="panel">';
            foreach($studentsNotDone as $student) {
                // print_r($student['progress'] . '::: PROGRESS' . ' === ');
                $accordion .=   '<div>' .
                                    '<h3 style="font-size:1.3em; color:#7b1113; margin: 1em 0 0.3em 0;">' . $student['student_name'] . '</h3>' .
                                    '<div class="progress">' .
                                        '<div class="progress-bar progress-bar-striped bg-success progress-bar-animated" style="width:' . $student['progress'] . '%">' . $student['progress'] . '%</div>' .
                                    '</div>' .
                                '</div>';
            }
            $accordion .= '</div>';
            return $accordion;
        }
        return false;
    }

    /**
     * Fetch students not yet finished evaluating a subject
     */
    protected function getUnfinished($subjectID)
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
                'student_name' => $sheet->full_name,
                'progress' => sprintf('%.0f', $this->computeProgress($studentAnswers[0]->answersTotal, $size))
            ];
        }

        // echo json_encode($progress);
        return $progress;
    }

    protected function get_progress_by_subject($subject_id = null)
    {
        if(isset($subject_id)) {
            $userModel = new UserModel();
            $evalSheetModel = new EvalSheetModel();

            $students_per_subjects = $userModel->get_all_students_per_subject($subject_id);
            if ($students_per_subjects === '0') {
                return ('No students');
            } else {
                $student_who_evaluated = $evalSheetModel->get_all_students_who_evaluated($subject_id);

                $percentage = ($student_who_evaluated / $students_per_subjects) * 100;

                return $percentage;
            }
        } else {
            return ("Subject not found.");
        }
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
}
