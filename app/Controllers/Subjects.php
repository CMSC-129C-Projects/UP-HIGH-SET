<?php
namespace App\Controllers;

use \App\Models\SubjectModel;
use \App\Models\FacultyModel;
use \App\Models\UserModel;
use \App\Models\EvalSheetModel;

class Subjects extends BaseController
{
    public function _remap($method, $param1 = null)
    {
        switch($method)
        {
            case 'add_subject':
            case 'get_subjects_taken':
                $this->hasSession(0);
                return $this->$method();
                break;
            case 'student_subjects':
                if ($_SESSION['logged_user']['role'] === '1')
                    return redirect()->to(base_url('dashboard'));
                $this->hasSession(0);
                return $this->$method();
                break;
            case 'index':
                if ($_SESSION['logged_user']['role'] === '2')
                    return redirect()->to(base_url('dashboard'));
                $this->hasSession(0);
                return $this->$method($param1);
            default:
                return redirect()->to(base_url('dashboard'));
        }
    }

	public function index($faculty_id)
    {    
        $css = ['custom/profs/viewsubjects-style.css'];
        // $js = ['custom/evaluation/evalSubjects.js'];
        $data = [
            // 'js'  => addExternal($js, 'javascript'),
            'css' => addExternal($css, 'css')
        ];

        $subjectModel = new SubjectModel();
        $faculModel = new FacultyModel();

        $prof = $faculModel->where('is_deleted', 0)->find($faculty_id);
        $subjectsHandled = $subjectModel->get_subjects_by_faculty($faculty_id);

        $data['subjects'] = $subjectsHandled;
        $data['prof'] = $prof;

        return view('subjects/subjects', $data);
	}

    /**
     * Display subjects taken by a student (FOR student page)
     */
    public function student_subjects()
    {
        $css = ['custom/evaluation/evalSubjects.css'];
        $js = ['custom/evaluation/evalSubjects.js'];
        $data = [
            'css' => addExternal($css, 'css'),
            'js'  => addExternal($js, 'javascript')
        ];
        return view('evaluation/evaluationSubjects', $data);
    }

    public function add_subject()
    {
        // Initialize CSS
        $css = ['custom/alert.css'];
        $js = ['custom/alert.js'];

        $data = [
            'css'   => addExternal($css, 'css'),
            'js'   => addExternal($js, 'javascript')
        ];

        $data['validation'] = null;
        $data['message'] = null;
        $data['profs'] = $this->fetchProfessors();

        $rules['name'] = [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Please input a subject title'
            ]
        ];

        if($this->request->getMethod() == 'post') {
            if($this->validate($rules)) {
                $subjectModel = new SubjectModel();

                $values = [
                    'faculty_id' => $this->request->getPost('professors'),
                    'grade_level' => $this->request->getPost('gLevel'),
                    'name' => $this->request->getPost('name')
                ];

                if($subjectModel->insert($values)) {
                    $data['message'] = true;
                } else {
                    $data['message'] = false;
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('subjects/addSubjects', $data);
    }

    public function get_subjects_taken()
    {
        $userModel = new UserModel();
        $sessionStudent = $userModel->asArray()->find($_SESSION['logged_user']['id']);

        $subjectModel = new SubjectModel();
        $subjects = $subjectModel->get_subjects_taken($_SESSION['logged_user']['id'], $sessionStudent['grade_level']);

        echo json_encode($subjects);
    }

    /**
     * AUXILIARY FUNCTIONS
     */

    protected function fetchProfessors() {
        $faculModel = new FacultyModel();

        return ($profs = $faculModel->where('is_deleted', '0')->findAll()) ? $profs : null;
    }

    protected function hasSession($type) {
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