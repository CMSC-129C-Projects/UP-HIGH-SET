<?php
namespace App\Controllers;

use \App\Models\SubjectModel;
use \App\Models\FacultyModel;

class Subjects extends BaseController
{
    // protected $admin;
    // protected $userModel;

    // function __construct() {
    //     $this->userModel = new \App\Models\UserModel();
    //     $this->admin = new Admin();
    // }

	public function index($role) {
        
        $subjectModel = new SubjectModel();

        $subjectsHandled = $subjectModel->where('is_deleted', '0')->where('faculty_id', $role)->findAll();
        // $css = ['custom/profs/profs-style.css'];
        // $js = ['custom/profs/profs.js'];
        // $data = [
        //     'js'    => addExternal($js, 'javascript'),
        //     'css'   => addExternal($css, 'css')
        // ];
        $data = [
            'subjects' => $subjectsHandled
        ];

        return view('subjects/subjects', $data);
	}

    public function add_subject() {
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

    /**
     * AUXILIARY FUNCTIONS
     */

    protected function fetchProfessors() {
        $faculModel = new FacultyModel();

        return ($profs = $faculModel->where('is_deleted', '0')->findAll()) ? $profs : null;
    }
}