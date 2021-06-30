<?php
namespace App\Controllers;

use \App\Models\SubjectModel;
use \App\Models\FacultyModel;
use \App\Models\UserModel;
use \App\Models\EvalSheetModel;

class Subjects extends BaseController
{
    public function _remap($method, $param1 = null, $param2 = null)
    {
        $this->hasSession();

        switch($method)
        {
            case 'get_subjects_taken':
                $this->role_checking(['1','3']);
                return $this->$method();
                break;
            case 'student_subjects':
                $this->role_checking(['1','3']);
                return $this->$method();
                break;
            case 'delete_subject':
            case 'edit_subject':
                $this->role_checking(['2']);
                return $this->$method($param1, $param2);
            case 'add_subject':
            case 'get_all_subjects':
                $this->role_checking(['2']);
                return $this->$method();
                break;
            case 'index':
                $this->role_checking(['2']);
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
        $css = ['custom/alert.css', 'custom/addSubject.css'];
        $js = ['custom/alert.js'];

        $data = [
            'css'   => addExternal($css, 'css'),
            'js'   => addExternal($js, 'javascript')
        ];

        $data['validation'] = null;
        $data['status'] = null;
        $data['profs'] = $this->fetchProfessors();

        $rules = [
            'subjectname' => 'required',
            'professor'   => 'required',
            'gLevel'      => 'required'
        ];

        if($this->request->getMethod() == 'post') {
            if($this->validate($rules)) {
                $subjectModel = new SubjectModel();

                $values = [
                    'faculty_id' => $this->request->getPost('professor'),
                    'grade_level' => $this->request->getPost('gLevel'),
                    'name' => $this->request->getPost('subjectname')
                ];

                if($subjectModel->insert($values)) {
                    $data['status'] = true;
                } else {
                    $data['status'] = false;
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        $data['status'] = $data['status'] ? 'true' : (isset($data['status']) ? 'false' : null);

        return view('subjects/addSubjects', $data);
    }

    /**
     * Edit Subject
     */
    public function edit_subject($subject_id, $faculty_id)
    {
        $subjectModel = new SubjectModel();

        $data['validation'] = null;
        $data['status'] = null;

        $rules = [
            'subjectname' => 'required',
            'professor'   => 'required',
            'gLevel'      => 'required'
        ];

        if($this->request->getMethod() == 'post') {
            if($this->validate($rules)) {
                $values = [
                    'faculty_id' => $this->request->getPost('professor'),
                    'grade_level' => $this->request->getPost('gLevel'),
                    'name' => $this->request->getPost('subjectname')
                ];

                if($subjectModel->update($subject_id, $values)) {
                    $data['status'] = 'true';
                } else {
                    $data['status'] = 'false';
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        // Initialize CSS
        $css = ['custom/alert.css', 'custom/addSubject.css'];
        $js = ['custom/alert.js'];

        $data['css'] = addExternal($css, 'css');
        $data['js'] = addExternal($js, 'javascript');

        
        $data['profs'] = $this->fetchProfessors();
        $data['selected_prof_id'] = $faculty_id;
        $data['subject_info'] = $subjectModel->find($subject_id);

        return view('subjects/editSubjects', $data);
    }

    public function delete_subject($subject_id = null, $prof_id = null)
    {
        if(isset($subject_id))
        {
            $subjectModel = new SubjectModel();

            $value = ['is_deleted' => 1];
            $result = $subjectModel->update($subject_id, $value);

            if(!$result)
                return false;
            else
                return redirect()->to(base_url('/' . 'view_subjects/' . $prof_id));
        }

        return false;
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
     * Get all subjects
     * in the database
     */
    public function get_all_subjects()
    {
        $subjectModel = new SubjectModel();
        if (!$subjects = $subjectModel->where('is_deleted', 0)->findAll()) {
            $response = [
                'is_available' => 0,
                'message' => 'No subjects found.'
            ];
        } else {
            $response = [
                'is_available' => 1,
                'subjects' => $subjects
            ];
        }
        echo json_encode($response);
    }

    /**
     * AUXILIARY FUNCTIONS
     */

    protected function fetchProfessors() {
        $faculModel = new FacultyModel();

        return ($profs = $faculModel->where('is_deleted', '0')->findAll()) ? $profs : null;
    }
}
