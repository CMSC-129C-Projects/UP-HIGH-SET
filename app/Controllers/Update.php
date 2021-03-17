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
        $data = $this->setDefaultData();
        
        // Place view file here
		// return view('sample', $data);
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

    protected function setDefaultData() {
        $student = new \App\Entities\Student();
        $student = $this->userModel->find(2);

        if ($student) {
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
}
