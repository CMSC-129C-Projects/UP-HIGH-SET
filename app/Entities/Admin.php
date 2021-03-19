<?php
namespace App\Entities;

class Admin extends Account {
    protected $newStudent;
    protected $userModel;

    function __construct($userModel) {
        $this->newStudent = new \App\Entities\Student();
        $this->userModel = $userModel;
    }

    public function addStudent($request) {
        $this->newStudent->student_num = $request->getPost('student_no');
        $this->newStudent->first_name = $request->getPost('fName');
        $this->newStudent->last_name = $request->getPost('lName');
        $this->newStudent->role = $request->getPost('role');
        $this->newStudent->grade_level = $request->getPost('gLevel');
        $this->newStudent->contact_num = $request->getPost('cNo');
        $this->newStudent->username = $request->getPost('uName');
        $this->newStudent->email = $request->getPost('email');

        $password = randomize_password($this->newStudent->student_num);
        $this->newStudent->password = password_hash($password, PASSWORD_BCRYPT);

        $this->newStudent->is_active = 1;
        $this->newStudent->is_deleted = 0;

        
        $subject = 'Account Verification';
        $message = 'Congratulations';
        send_acc_notice($this->newStudent->email, $subject, $message);
        $this->userModel->insert($this->newStudent);
    }

    public function editStudent($request, $id) {
        $this->newStudent->student_num = $request->getPost('student_no');
        $this->newStudent->first_name = $request->getPost('fName');
        $this->newStudent->last_name = $request->getPost('lName');
        $this->newStudent->role = $request->getPost('role');
        $this->newStudent->grade_level = $request->getPost('gLevel');
        $this->newStudent->contact_num = $request->getPost('cNo');
        $this->newStudent->username = $request->getPost('uName');
        $this->newStudent->email = $request->getPost('email');

        $this->userModel->update($id, $this->newStudent);
    }

    public function deleteStudent($id) {
        $this->newStudent->is_deleted = 1;
        $this->userModel->update($id, $this->newStudent);
    }
}