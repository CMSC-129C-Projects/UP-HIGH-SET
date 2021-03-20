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

	public function index($action) {
        // review action
        $data = $this->setDefaultData();
        
        if($this->request->getMethod() == 'post') {
            if($this->validate(setRule())) {
                if($action == 'add') {

                } elseif ($action == 'edit') {

                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        // Place view file here
		// return view('sample', $data);
	}

    public function test() {
        return view('accountRegistration');
    }

    public function removal() {
        $data['studentList'] = $this->userModel->findAll();

        // Place view file here
        // return view('deletion', $data);
    }

    public function add() {
        if($this->request->getMethod() == 'post')
            $this->admin->addStudent($this->request);
    }

    public function edit() {
        if($this->request->getMethod() == 'post')
            $this->admin->editStudent($this->request, $id);
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
        if(!isset($id)) {
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
            $data['emall'] = $student->email;
        } else {
            $data['sNo'] = '';
            $data['fName'] = '';
            $data['lName'] = '';
            $data['uName'] = '';
            $data['cn'] = '';
            $data['glevel'] = '';
            $data['emall'] = '';
        }
        return $data;
    }

    protected function setRules() {
        $rules = [
            'sampleName1' => [
                'rules' => 'sampleRule1|sampleRule2',
                'errors' => [
                    'sampleRule1' => 'rule1-message',
                    'sampleRule2' => 'rule2-message'
                ]
            ],
            'sampleName2' => [
                'rules' => 'sampleRule1|sampleRule2',
                'errors' => [
                    'sampleRule1' => 'rule1-message',
                    'sampleRule2' => 'rule2-message'
                ]
            ]
        ];

        return $rules;
    }
}
