<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Profile extends BaseController
{
    public function index() {
        $role = $_SESSION['role'];

        // redirect to login if no session found
        // redirect to verifyAccount page if session not yet verified
        if (!$this->session->has('logged_user')) {
            return redirect()->to(base_url('login'));
        } elseif (!$_SESSION['logged_user']['emailVerified']) {
            return redirect()->to(base_url('verifyAccount'));
        }

        $data = $this->setDefaultData($role, $id);

        $data['validation'] = null;
        $data['status'] = null;
        $data['role'] = $role;
        $data['id'] = $id;

        if($this->request->getMethod() == 'post') {
            if($this->validate($this->setRules($role, $id))) {
                $data['status'] = $this->admin->editUser($this->request, $role, $id);
            } else {
                $data['validation'] = $this->validator;
            }
        }

        $css = ['custom/alert.css'];
        $js = ['custom/alert.js'];
        $data['css'] = addExternal($css, 'css');
        $data['js'] = addExternal($js, 'javascript');

        // return view('user_mgt/dashboard');
    }

    /**
     * AUXILIARY FUNCTIONS
     */

    protected function setDefaultData($role = null, $id = null) {
        if($role === 'student') {
            $student = new \App\Entities\Student();
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
            $adminUpdate = new \App\Entities\Admin();
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
        if($role === 'student') {
            $rules = [
                'studFirstName' => 'required',
                'studLastName' => 'required',
                'gradeLevel' => 'required'
            ];
            if(isset($id)) {
                $rules['studNum'] = [
                    'rules'     => 'required|min_length[9]|owned_student_number['. $id .']',
                    'errors'    => [
                        'is_existing_data'  => 'Student number already exist'
                    ]
                ];
                $rules['studEmail'] = [
                    'rules'     => 'required|valid_email|is_UP_mail|owned_email['.$id.']',
                    'errors'    => [
                        'is_UP_mail'    => 'The email you entered is not a valid UP mail',
                        'isUniqueEmail' => 'Email is already taken'
                    ]
                ];
            } else {
                $rules['studNum'] = [
                    'rules'     => 'required|min_length[9]|is_existing_data',
                    'errors'    => [
                        'is_existing_data'  => 'Student number already exist'
                    ]
                ];
                $rules['studEmail'] = [
                    'rules'     => 'required|valid_email|is_UP_mail|isUniqueEmail',
                    'errors'    => [
                        'is_UP_mail'    => 'The email you entered is not a valid UP mail',
                        'isUniqueEmail' => 'Email is already taken'
                    ]
                ];
            }
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
}
