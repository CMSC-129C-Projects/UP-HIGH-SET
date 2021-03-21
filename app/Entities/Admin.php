<?php
namespace App\Entities;

class Admin extends Account {

    public $action;
    protected $newStudent;
    protected $userModel;

    function __construct($userModel) {
        $this->action = "";
        $this->newStudent = new \App\Entities\Student();
        $this->userModel = $userModel;
    }

    public function addStudent($request, $role) {
        $this->newStudent->student_num = $request->getPost('studNum');
        $this->newStudent->first_name = $request->getPost('studFirstName');
        $this->newStudent->last_name = $request->getPost('studLastName');
        $this->newStudent->role = (int)$role;
        $this->newStudent->grade_level = $request->getPost('gradeLevel');
        $this->newStudent->contact_num = $request->getPost('studContactNum');
        $this->newStudent->username = $request->getPost('studUserName');
        $this->newStudent->email = $request->getPost('studEmail');

        $password = randomize_password($this->newStudent->student_num);
        $this->newStudent->password = password_hash($password, PASSWORD_BCRYPT);

        $this->newStudent->is_active = 1;
        $this->newStudent->is_deleted = 0;

        
        // $subject = 'Account Verification';
        // $message = 'Congratulations';
        // send_acc_notice($this->newStudent->email, $subject, $message);
        $this->userModel->insert($this->newStudent);
    }

    public function editStudent($request, $id) {
        $this->newStudent->student_num = $request->getPost('studNum');
        $this->newStudent->first_name = $request->getPost('studFirstName');
        $this->newStudent->last_name = $request->getPost('studLastName');
        $this->newStudent->role = $request->getPost('btn-student');
        $this->newStudent->grade_level = $request->getPost('gradeLevel');
        $this->newStudent->contact_num = $request->getPost('studContactNum');
        $this->newStudent->username = $request->getPost('studUserName');
        $this->newStudent->email = $request->getPost('studEmail');

        $this->userModel->update($id, $this->newStudent);
    }

    public function deleteStudent($id) {
        $this->newStudent->is_deleted = 1;
        $this->userModel->update($id, $this->newStudent);
    }
}