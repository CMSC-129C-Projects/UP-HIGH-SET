<?php
namespace App\Entities;

class Admin extends Account {
    protected $newStudent;
    protected $userModel;

    function __construct() {
        $this->newStudent = new \App\Entities\Student();
        $this->$userModel = new \App\Models\UserModel();
    }

    public function addStudent($request) {
        $this->newStudent->student_num = $request->getPost();
        $this->newStudent->first_name = $request->getPost();
        $this->newStudent->last_name = $request->getPost();
        $this->newStudent->role = $request->getPost();
        $this->newStudent->grade_level = $request->getPost();
        $this->newStudent->contact_num = $request->getPost();
        // insert password here
        $this->newStudent->email = $request->getPost();

        $subject = 'Account Verification';
        $message = 'Congratulations';
        send_acc_notice($this->newStudent->email, $subject, $message);
        $this->userModel->insert($this->newStudent);
    }

    public function editStudent($request, $id) {
        $this->newStudent->student_num = $request->getPost();
        $this->newStudent->first_name = $request->getPost();
        $this->newStudent->last_name = $request->getPost();
        $this->newStudent->role = $request->getPost();
        $this->newStudent->grade_level = $request->getPost();
        $this->newStudent->contact_num = $request->getPost();
        $this->newStudent->email = $request->getPost();

        $this->userModel->update($id, $this->newStudent);
    }

    public function deleteStudent($id) {
        $this->newStudent->is_deleted = 1;
        $this->userModel->update($id, $this->newStudent);
    }
}