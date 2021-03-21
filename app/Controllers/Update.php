<?php
namespace App\Controllers;

use \App\Entities\Admin;

class Update extends BaseController
{
    protected $admin;
    protected $userModel;

    function __construct() {
        $this->userModel = new \App\Models\UserModel();
        $this->admin = new Admin($this->userModel);
    }

	public function index() {
        $css = ['custom/table.css'];
        $js = ['custom/showList.js'];
        $data = [
            'js'    => addExternal($js, 'javascript'),
            'css'   => addExternal($css, 'css')
        ];

        // Place view file here
		return view('showTables', $data);
	}

    public function studentList() {
        $data['studentList'] = $this->userModel->findAll();

        // Place view file here
        // return view('deletion', $data);
        echo json_encode($data['studentList']);
    }

    public function add($role = null) {
        $data = $this->setDefaultData();

        $js = ['custom/add.js'];
        $data['js'] = addExternal($js, 'javascript');

        $data['validation'] = null;
        $data['type'] = 'add';

        if($this->request->getMethod() == 'post') {
            if($this->validate($this->setRules())) {
                $this->admin->addStudent($this->request, $role);
                return 'success';
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('accountRegistration', $data);
    }

    public function edit($role = null, $id = null) {
        $data = $this->setDefaultData($id);
        $data['validation'] = null;
        $data['type'] = 'edit';

        if($this->request->getMethod() == 'post') {
            if($this->validate($this->setRules())) {
                $this->admin->editStudent($this->request, $id);
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('accountRegistration', $data);
    }

    public function delete() {
        $this->admin->deleteStudent($id);
    }


    /**
     * FUNCTIONS BELOW ARE FOR EXTRA TASKS ONLY
     */

    protected function setDefaultData($id = null) {
        $student = new \App\Entities\Student();
        $hasDefaultValues = false;
        if(isset($id)) {
            $hasDefaultValues = true;
            $student = $this->userModel->find($id);
        }

        if ($hasDefaultValues) {
            $data['sNo'] = $student->student_num;
            $data['fName'] = $student->first_name;
            $data['lName'] = $student->last_name;
            $data['uName'] = $student->username;
            $data['cn'] = $student->contact_num;
            $data['glevel'] = $student->grade_level;
            $data['email'] = $student->email;
        } else {
            $data['sNo'] = '';
            $data['fName'] = '';
            $data['lName'] = '';
            $data['uName'] = '';
            $data['cn'] = '';
            $data['glevel'] = '';
            $data['email'] = '';
        }
        return $data;
    }

    protected function setRules() {
        // $rules = [
        //     'sampleName1' => [
        //         'rules' => 'sampleRule1|sampleRule2',
        //         'errors' => [
        //             'sampleRule1' => 'rule1-message',
        //             'sampleRule2' => 'rule2-message'
        //         ]
        //     ],
        //     'sampleName2' => [
        //         'rules' => 'sampleRule1|sampleRule2',
        //         'errors' => [
        //             'sampleRule1' => 'rule1-message',
        //             'sampleRule2' => 'rule2-message'
        //         ]
        //     ]
        // ];
        $rules = [
            'studNum' => 'required',
            'studFirstName' => 'required',
            'studLastName' => 'required',
            'gradeLevel' => 'required',
            'studContactNum' => 'required',
            'studUserName' => 'required',
            'studEmail' => 'required'
        ];

        return $rules;
    }
}
