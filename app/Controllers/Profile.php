<?php
namespace App\Controllers;

use \App\Entities\Admin;
use \App\Entities\Student;
use \App\Models\UserModel;

class Profile extends BaseController
{
    protected $userModel;

    function __construct() {
        $this->userModel = new UserModel();
    }

    public function index() {
        $this->hasSession();

        $role = $_SESSION['logged_user']['role'];

        $sessionStudent = new Student();

        $sessionStudent = $this->userModel->where('is_deleted', 0)->where('email', $_SESSION['logged_user']['email'])->first();

        $data = $this->setDefaultData($role, $sessionStudent->id);

        $css = ['custom/profileUpdate/pUpdate.css'];
        $js = ['custom/profileUpdate/pUpdate.js'];
        $data['js'] = addExternal($js, 'javascript');
        $data['css'] = addExternal($css, 'css');

        $data['validation'] = null;
        // $data['status'] = null;
        $data['role'] = $role;
        // $data['id'] = $id;

        if($this->request->getMethod() == 'post') {
            if($this->validate($this->setRules($role, $sessionStudent->id))) {
                $data['status'] = $this->admin->editUser($this->request, $role, $id);
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view("account_updates/profileUpdate", $data);
    }

    /**
     * AUXILIARY FUNCTIONS
     */

    protected function setDefaultData($role = null, $id = null) {
        if($role == '2') {
            $student = new Student();
            if(isset($id)) {
                $id = (int)$id;
                $student = $this->userModel->find($id);
            }
            $data['sNo'] = $student->student_num;
            $data['fName'] = $student->first_name;
            $data['lName'] = $student->last_name;
            $data['uName'] = $student->username;
            $data['cn'] = $student->contact_num;
            $data['glevel'] = $student->grade_level;
            $data['email'] = $student->email;
        } else {
            $adminUpdate = new Admin();
            if(isset($id)) {
                $id = (int)$id;
                $adminUpdate = $this->userModel->asObject('App\Entities\Admin')->find($id);
            }
            $data['fN'] = $adminUpdate->first_name;
            $data['lN'] = $adminUpdate->last_name;
            $data['uN'] = $adminUpdate->username;
            $data['cN'] = $adminUpdate->contact_num;
            $data['eml'] = $adminUpdate->email;
        }

        return $data;
    }

    protected function setRules($role = null, $id = null) {
        if($role == '2') {
            $rules['username'] = [
                'rules'     => 'uniqueUsername['. $id .']',
                'errors'    => [
                    'is_existing_data'  => 'Student number already exist'
                ]
            ];
            $rules['mobile'] = [
                'rules'     => 'is_natural|valid_number',
                'errors'    => [
                    'is_natural'   => 'Contact number format: 09xxxxxxxxx',
                    'valid_number' => 'This is not a valid number'
                ]
            ];
        } else {
            $rules = [
                'adminFirstName' => 'required',
                'adminLastName' => 'required'
            ];
            if(isset($id)) {
                $rules['adminContactNum'] = [
                    'rules'     => 'required|min_length[11]|is_natural|valid_number|owned_contact['.$id.']',
                    'errors'    => [
                        'uniqueContact' => 'Contact number already exists',
                        'is_natural'   => 'Contact number format: 09xxxxxxxxx',
                        'valid_number' => 'This is not a valid number'
                    ]
                ];
                $rules['adminEmail'] = [
                    'rules'     => 'required|valid_email|is_UP_mail|owned_email['.$id.']',
                    'errors'    => [
                        'is_UP_mail'    => 'The email you entered is not a valid UP mail',
                        'isUniqueEmail' => 'Email is already taken'
                    ]
                ];
            } else {
                $rules['adminContactNum'] = [
                    'rules'     => 'required|uniqueContact|min_length[11]|is_natural|valid_number',
                    'errors'    => [
                        'uniqueContact' => 'Contact number already exists',
                        'is_natural'   => 'Contact number format: 09xxxxxxxxx',
                        'valid_number' => 'This is not a valid number'
                    ]
                ];
                $rules['adminEmail'] = [
                    'rules'     => 'required|valid_email|is_UP_mail|isUniqueEmail',
                    'errors'    => [
                        'is_UP_mail'    => 'The email you entered is not a valid UP mail',
                        'isUniqueEmail' => 'Email is already taken'
                    ]
                ];
            }
        }

        return $rules;
    }

    protected function hasSession() {
        // redirect to login if no session found
        // redirect to verifyAccount page if session not yet verified
        if (!$this->session->has('logged_user')) {
            return redirect()->to(base_url('login'));
        } elseif (!$_SESSION['logged_user']['emailVerified']) {
            return redirect()->to(base_url('verifyAccount'));
        }
    }
}
