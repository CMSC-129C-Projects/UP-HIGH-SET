<?php
namespace App\Entities;

class Admin extends Account {

    public $action;
    protected $newStudent;
    protected $userModel;

    function __construct() {
        $this->newStudent = new \App\Entities\Student();
        $this->userModel = new \App\Models\UserModel();
    }

    public function addUser($request, $role) {
        $status = true;

        if($role === 'student') {
            $this->newStudent->student_num = $request->getPost('studNum');

            $this->newStudent->first_name = $request->getPost('studFirstName');
            $this->newStudent->last_name = $request->getPost('studLastName');
            $this->newStudent->role = 1;
            $this->newStudent->grade_level = $request->getPost('gradeLevel');
            $this->newStudent->contact_num = $request->getPost('studContactNum');
            $this->newStudent->username = $request->getPost('studUserName');
            $this->newStudent->email = $request->getPost('studEmail');

            $password = randomize_password($this->newStudent->student_num);
            $this->newStudent->password = password_hash($password, PASSWORD_BCRYPT);

            $this->newStudent->is_active = 1;
            $this->newStudent->is_deleted = 0;

            // Send account notice to student
            $search = ['-student-','-password-', '-website_link-'];
            $replace = [$this->newStudent->first_name, $password, base_url()];

            $subject = 'Account Notification';
            $message = file_get_contents(base_url() . '/app/Views/emailTemplate.html');

            $message = str_replace($search, $replace, $message);
            
            $status = send_acc_notice($this->newStudent->email, $subject, $message);
            // Send account notice to student

            try {
                $this->userModel->insert($this->newStudent);
            } catch (\Exception $e) {
                $status = false;
            }

        } else {
            $newAdmin = new self();

            $newAdmin->first_name = $request->getPost('adminFirstName');
            $newAdmin->last_name = $request->getPost('adminLastName');
            $newAdmin->role = 0;
            $newAdmin->contact_num = $request->getPost('adminContactNum');
            $newAdmin->username = $request->getPost('adminUserName');
            $newAdmin->email = $request->getPost('adminEmail');

            $password = randomize_password($newAdmin->contact_num);
            $newAdmin->password = password_hash($password, PASSWORD_BCRYPT);

            $newAdmin->is_active = 1;
            $newAdmin->is_deleted = 0;

            $statue = true;
            
            try {
                $this->userModel->insert($newAdmin);
            } catch (\Exception $e) {
                $status = false;
            }
        }

        return $status;
    }

    public function editUser($request, $role, $id) {
        $status = true;
        if($role === 'student') {
            $this->newStudent = $this->userModel->find($id);

            $this->newStudent->student_num = $request->getPost('studNum');
            $this->newStudent->first_name = $request->getPost('studFirstName');
            $this->newStudent->last_name = $request->getPost('studLastName');
            $this->newStudent->grade_level = $request->getPost('gradeLevel');
            $this->newStudent->contact_num = $request->getPost('studContactNum');
            $this->newStudent->username = $request->getPost('studUserName');
            $this->newStudent->email = $request->getPost('studEmail');

            try {
                $this->userModel->update($id, $this->newStudent);
            } catch (\Exception $e) {
                $status = false;
            }
        } else {
            $newAdmin = new self();
            $newAdmin = $this->userModel->asObject('App\Entities\Admin')->find($id);

            $newAdmin->first_name = $request->getPost('adminFirstName');
            $newAdmin->last_name = $request->getPost('adminLastName');
            $newAdmin->contact_num = $request->getPost('adminContactNum');
            $newAdmin->username = $request->getPost('adminUserName');
            $newAdmin->email = $request->getPost('adminEmail');

            try{
                $this->userModel->update($id, $newAdmin);
            } catch (\Exception $e) {
                $status = false;
            }
        }

        return $status;
    }

    public function deleteUser($id, $role) {
        if($role === 'student') {
            $this->newStudent = $this->userModel->find($id);
            $this->newStudent->is_deleted = 1;
            $this->userModel->update($id, $this->newStudent);
        } else {
            $newAdmin = new self();

            $newAdmin = $this->userModel->asObject('App\Entities\Admin')->find($id);
            $newAdmin->is_deleted = 1;
            $this->userModel->update($id, $newAdmin);
        }
    }
}