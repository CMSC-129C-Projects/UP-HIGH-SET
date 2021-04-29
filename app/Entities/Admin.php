<?php
namespace App\Entities;

use App\Models\EmailModel;

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

        // For sending account notice
        $emailModel = new EmailModel();
        $emailContent = $emailModel->where('is_deleted', '0')->where('purpose','registration')->orderBy('created_on', 'desc')->first();
        $search = ['-content-', '-student-','-email-','-password-', '-website_link-'];
        $subject = $emailContent['title'];
        $message = file_get_contents(base_url() . '/app/Views/emailTemplate.html');
        // For sending account notice

        if($role === 'student' || $role == '2') {
            $this->newStudent->student_num = $request->getPost('studNum');

            $this->newStudent->first_name = $request->getPost('studFirstName');
            $this->newStudent->last_name = $request->getPost('studLastName');
            $this->newStudent->role = 2;
            $this->newStudent->grade_level = $request->getPost('gradeLevel');
            // $this->newStudent->contact_num = $request->getPost('studContactNum');
            // $this->newStudent->username = $request->getPost('studUserName');
            $this->newStudent->email = $request->getPost('studEmail');

            $password = randomize_password($this->newStudent->student_num);
            $this->newStudent->password = password_hash($password, PASSWORD_BCRYPT);

            $this->newStudent->is_active = 1;
            $this->newStudent->is_deleted = 0;

            // Send account notice to student
            $replace = [$emailContent['message'], $this->newStudent->first_name, $this->newStudent->email, $password, base_url()];

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
            $newAdmin->role = 1;
            $newAdmin->contact_num = $request->getPost('adminContactNum');
            // $newAdmin->username = $request->getPost('adminUserName');
            $newAdmin->email = $request->getPost('adminEmail');

            $password = randomize_password($newAdmin->contact_num);
            $newAdmin->password = password_hash($password, PASSWORD_BCRYPT);

            $newAdmin->is_active = 1;
            $newAdmin->is_deleted = 0;

            // Send account notice to admin
            $replace = [$emailContent['message'], $newAdmin->first_name, $newAdmin->email, $password, base_url()];

            $message = str_replace($search, $replace, $message);

            $status = send_acc_notice($newAdmin->email, $subject, $message);
            // Send account notice to admin

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
        if($role === 'student' || $role == '2') {
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
            // $newAdmin = $this->userModel->asObject('App\Entities\Admin')->find($id);
            $newAdmin = $this->userModel->find($id);

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
        if($role === 'student' || $role == '2') {
            $this->newStudent = $this->userModel->find($id);
            $this->newStudent->is_deleted = 1;
            $this->userModel->update($id, $this->newStudent);
        } else {
            $newAdmin = new self();

            // $newAdmin = $this->userModel->asObject('App\Entities\Admin')->find($id);
            $newAdmin = $this->userModel->find($id);
            $newAdmin->is_deleted = 1;
            $this->userModel->update($id, $newAdmin);
        }
    }
}
