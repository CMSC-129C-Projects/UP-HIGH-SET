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
        switch($method) {
            case 'monitor_progress':
            case 'update_set_status':
                $this->hasSession(0);
                if ($_SESSION['logged_user']['role'] === '2')
                    return redirect()->to(base_url('dashboard'));
                else
                    return $this->$method();
                break;
            case 'get_subjects':
                $this->hasSession(1);
                $this->$method($param1);
                break;
            case 'transcend_students':
                $this->hasSession(1);
                $this->$method($param1);
                break;
            case 'count_sheet_per_status_per_subject':
                $this->hasSession(1);
                $this->$method();
                break;
            default:

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
        // insert logic for validation form checking
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

        /**
         * Use this when frontend is ready
         */ 
        // $values = [
        //     'name' => $this->request->getPost('name'),
        //     'status' => 'open',
        //     'date_start' => $this->request->getPost('date_start'),
        //     'date_end' => $this->request->getPost('date_end'),
        //     'year_start' => $this->request->getPost('year_start'),
        //     'year_end' => $this->request->getPost('year_end'),
        // ];

        $values = [
            'name' => 'Semeter 2',
            'status' => 'open',
            'date_start' => date('Y-m-d H:i:s'),
            'date_end' => date('Y-m-d H:i:s'),
            'year_start' => '2021',
            'year_end' => '2022',
        ];

        $evaluationModel->insert($values);
        $evaluation_id = $evaluationModel->getInsertID();

        $this->generate_eval_sheets($evaluation_id);

        if ($db->transStatus() === FALSE) {
            $db->transRollback();
        } else {
            $db->transCommit();
        }
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
            $accordion = '<button class="accordion">Student Not Finished Evaluating</button><div class="panel">';
            foreach($studentsNotDone as $student) {
                $accordion .=   '<div>' .
                                    '<p>' . $student['student_name'] . '</p>' .
                                    '<div class="progress">' .
                                        '<div class="progress-bar bg-danger" style="width:' . $student['progress'] . '%">' . $student['progress'] . '%</div>' .
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


    /**
     * Check current session
     */
    protected function hasSession($type)
    {
        if ($type === 0) {
            // redirect to login if no session found
            // redirect to verifyAccount page if session not yet verified
            if (!$this->session->has('logged_user')) {
                return redirect()->to(base_url('login'));
            } elseif (!$_SESSION['logged_user']['emailVerified']) {
                return redirect()->to(base_url('verifyAccount'));
            }
        } else {
            // redirect to login if no session found
            if (!$this->session->has('logged_user')) {
                return redirect()->to(base_url());
            } elseif ($_SESSION['logged_user']['role'] != '1') {
                return redirect()->to(base_url());
            } elseif (!$_SESSION['logged_user']['emailVerified']) {
                return redirect()->to(base_url('verifyAccount'));
            }
        }
    }
}
