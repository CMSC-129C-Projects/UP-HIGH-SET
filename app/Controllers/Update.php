<?php
namespace App\Controllers;

use \App\Entities\Admin;

class Update extends BaseController
{
    protected $admin;
    protected $userModel;

    function __construct() {
        $this->userModel = new \App\Models\UserModel();
        $this->admin = new Admin();
    }

	public function index($role) {

        // redirect to login if no session found
        if (!$this->session->has('logged_user')) {
            return redirect()->to(base_url());
        }

        $css = ['custom/table.css', 'custom/alert.css'];
        $js = ['custom/showList.js', 'custom/alert.js'];
        $data = [
            'js'    => addExternal($js, 'javascript'),
            'css'   => addExternal($css, 'css')
        ];

        if(isset($role) && $role === 'student') {
            return view('studentList', $data);   
        } else {
            return view('adminList', $data);
        }
	}

    public function add($role = null) {

        // redirect to login if no session found
        if (!$this->session->has('logged_user')) {
            return redirect()->to(base_url());
        }

        $data['role'] = $role;
        $data['validation'] = null;
        $emailStatus = null;

        if($this->request->getMethod() == 'post') {
            if($this->validate($this->setRules($role))) {
                $emailStatus = $this->admin->addUser($this->request, $role);
            } else {
                $data['validation'] = $this->validator;
            }
        }

        $data['emailStatus'] = $emailStatus;

        $css = ['custom/alert.css'];
        $js = ['custom/alert.js'];
        $data['css'] = addExternal($css, 'css');
        $data['js'] = addExternal($js, 'javascript');

        return view('accountRegistration', $data);
    }

    public function edit($role = null, $id = null) {

        // redirect to login if no session found
        if (!$this->session->has('logged_user')) {
            return redirect()->to(base_url());
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

        return view('editAccount', $data);
    }

    public function delete($id, $role = null) {

        // redirect to login if no session found
        if (!$this->session->has('logged_user')) {
            return redirect()->to(base_url());
        }

        $this->admin->deleteUser($id, $role);
        return redirect()->to(base_url('update/' . $role));
    }

    /**
     * AUXILIARY FUNCTIONS BELOW
     */

    public function studentList($gradeLevel = null) {
        $data['studentList'] = $this->userModel->where('grade_level', $gradeLevel)->where('is_deleted', 0)->findAll();

        echo json_encode($data['studentList']);
    }

    public function adminList() {
        $data['adminList'] = $this->userModel->where('role', 0)->where('is_deleted', 0)->findAll();

        echo json_encode($data['adminList']);
    }

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
                'gradeLevel' => 'required',
                'studContactNum' => [
                    'rules'     => 'min_length[11]|is_natural|valid_number',
                    'errors'    => [
                        'is_natural'   => 'Contact number format: 09xxxxxxxxx',
                        'valid_number' => 'This is not a valid number'
                    ]
                ],
                'studUserName' => 'min_length[6]',
                'studEmail' => [
                    'rules'     => 'required|valid_email|is_UP_mail|isUniqueEmail',
                    'errors'    => [
                        'is_UP_mail'    => 'The email you entered is not a valid UP mail',
                        'isUniqueEmail' => 'Email is already taken'
                    ]
                ]
            ];
            if(isset($id)) {
                $rules['studNum'] = [
                    'rules'     => 'required|min_length[9]|owned_student_number['. $id .']',
                    'errors'    => [
                        'is_existing_data'  => 'Student number already exist'
                    ]
                ];
            } else {
                $rules['studNum'] = [
                    'rules'     => 'required|min_length[9]|is_existing_data',
                    'errors'    => [
                        'is_existing_data'  => 'Student number already exist'
                    ]
                ];
            }
        } else {
            $rules = [
                'adminFirstName' => 'required',
                'adminLastName' => 'required',
                'adminContactNum' => [
                    'rules'     => 'required|uniqueContact|min_length[11]|is_natural|valid_number',
                    'errors'    => [
                        'uniqueContact' => 'Contact number already exists',
                        'is_natural'   => 'Contact number format: 09xxxxxxxxx',
                        'valid_number' => 'This is not a valid number'
                    ]
                ],
                'adminEmail' => [
                    'rules'     => 'required|valid_email|is_UP_mail|isUniqueEmail',
                    'errors'    => [
                        'is_UP_mail'    => 'The email you entered is not a valid UP mail',
                        'isUniqueEmail' => 'Email is already taken'
                    ]
                ]
            ];
        }

        return $rules;
    }
}
