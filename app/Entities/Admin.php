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
        $this->newStudent->role = ($role == 'student')? 1: 0;
        $this->newStudent->grade_level = $request->getPost('gradeLevel');
        $this->newStudent->contact_num = $request->getPost('studContactNum');
        $this->newStudent->username = $request->getPost('studUserName');
        $this->newStudent->email = $request->getPost('studEmail');

        $password = randomize_password($this->newStudent->student_num);
        $this->newStudent->password = password_hash($password, PASSWORD_BCRYPT);

        $this->newStudent->is_active = 1;
        $this->newStudent->is_deleted = 0;

        // Send account notice to student

        $search = ['-student-','-username-','-password-', '-website_link-'];
        $replace = [$this->newStudent->first_name, $this->newStudent->username, $password, base_url()];

        $subject = 'Account Notification';
        $message = file_get_contents(base_url() . '/app/Views/emailTemplate.html');

        $message = str_replace($search, $replace, $message);
        
        $emailStatus = send_acc_notice($this->newStudent->email, $subject, $message);
        // Send account notice to student

        try {
            $this->userModel->insert($this->newStudent);
        } catch (\Exception $e) {
            $emailStatus = false;
        }

        return $emailStatus;
    }

    public function editStudent($request, $role, $id) {
        $this->newStudent = $this->userModel->find($id);

        $this->newStudent->student_num = $request->getPost('studNum');
        $this->newStudent->first_name = $request->getPost('studFirstName');
        $this->newStudent->last_name = $request->getPost('studLastName');
        $this->newStudent->grade_level = $request->getPost('gradeLevel');
        $this->newStudent->contact_num = $request->getPost('studContactNum');
        $this->newStudent->username = $request->getPost('studUserName');
        $this->newStudent->email = $request->getPost('studEmail');

        $this->userModel->update($id, $this->newStudent);
    }

    public function deleteStudent($id) {
        $this->newStudent = $this->userModel->find($id);
        $this->newStudent->is_deleted = 1;
        $this->userModel->update($id, $this->newStudent);
    }
}