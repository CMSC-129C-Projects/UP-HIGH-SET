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

    public function _remap($method, $param1=null, $param2=null)
    {
        $this->hasSession();

        switch($method)
        {
            case 'index':
            case 'add':
            case 'studentList':
                $this->role_checking(['2']);
                return $this->$method($param1);
                break;
            case 'update_2fverification':
                return $this->$method($param1);
                break;
            case 'edit':
            case 'delete':
                $this->role_checking(['2']);
                return $this->$method($param1, $param2);
                break;
            case 'adminList':
            case 'clerkList':
                $this->role_checking(['2']);
                return $this->$method();
                break;
            default:
                return redirect()->to(base_url('dashboard'));
        }
    }

	public function index($role)
    {
        $css = ['custom/table.css', 'custom/alert.css'];
        $js = ['custom/showList.js', 'custom/alert.js'];
        $data = [
            'js'    => addExternal($js, 'javascript'),
            'css'   => addExternal($css, 'css')
        ];

        if(isset($role) && $role === 'student') {
            return view('user_list/studentList', $data);
        } elseif (isset($role) && $role === 'admin') {
            return view('user_list/adminList', $data);
        } else {
            return view('user_list/clerkList', $data);
        }
	}

    public function add($role = null)
    {
        $data['role'] = $role;
        $data['validation'] = null;
        $data['status'] = null;

        if($this->request->getMethod() == 'post') {
            if($this->validate($this->setRules($role))) {
                $data['status'] = $this->admin->addUser($this->request, $role);
            } else {
                $data['validation'] = $this->validator;
            }
        }
        $data['status'] = $data['status'] ? 'true' : (isset($data['status']) ? 'false' : null);

        $css = ['custom/alert.css'];
        $js = ['custom/alert.js', 'custom/glevel.js'];
        $data['css'] = addExternal($css, 'css');
        $data['js'] = addExternal($js, 'javascript');

        return view('account_updates/accountRegistration', $data);
    }

    public function edit($role = null, $id = null)
    {
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

        $data['status'] = $data['status'] ? 'true' : (isset($data['status']) ? 'false' : null);

        $css = ['custom/alert.css'];
        $js = ['custom/alert.js'];
        $data['css'] = addExternal($css, 'css');
        $data['js'] = addExternal($js, 'javascript');

        return view('account_updates/editAccount', $data);
    }

    public function delete($id, $role = null)
    {
        $this->admin->deleteUser($id, $role);
        return redirect()->to(base_url('update/' . $role));
    }

    /**
     * AUXILIARY FUNCTIONS BELOW
     */

    public function studentList($gradeLevel = null)
    {
        $data['studentList'] = $this->userModel->where('role','2')->where('grade_level', $gradeLevel)->where('is_deleted', 0)->findAll();

        echo json_encode($data['studentList']);
    }

    public function adminList()
    {
        $data['adminList'] = $this->userModel->where('role', 1)->where('is_deleted', 0)->findAll();

        echo json_encode($data['adminList']);
    }

    public function clerkList()
    {
        $data['clerkList'] = $this->userModel->where('role', 3)->where('is_deleted', 0)->findAll();

        echo json_encode($data['clerkList']);
    }

    public function update_2fverification($toggle)
    {
        $value = ['allow_verify' => (($toggle === 'true') ? '1' : '0')];

        if (!$this->userModel->update($_SESSION['logged_user']['id'], $value)) {
            $response = ['message' => 'failed'];
        } else  {
            $_SESSION['logged_user']['allow_verify'] = (($toggle === 'true') ? true : false);
            $response = ['message' => 'success'];
        }
        echo json_encode($response);
    }

    protected function setDefaultData($role = null, $id = null)
    {
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

    protected function setRules($role = null, $id = null)
    {
        if($role === 'student') {
            $rules = [
                'studFirstName' => 'required',
                'studLastName' => 'required',
                'gradeLevel' => [
                    'rules'  => 'required|correctGradeLevel',
                    'errors' => [
                        'correctGradeLevel' => 'Please choose a grade level'
                    ]
                ]
            ];
            if(isset($id)) {
                $rules['studNum'] = [
                    'rules'     => 'required|min_length[8]|owned_student_number['. $id .']',
                    'errors'    => [
                        'is_existing_data'  => 'Student number already exist'
                    ]
                ];
                $rules['studEmail'] = [
                    'rules'     => 'required|owned_email['.$id.']',
                    'errors'    => [
                        'is_UP_mail'    => 'The email you entered is not a valid UP mail',
                        'isUniqueEmail' => 'Email is already taken'
                    ]
                ];
            } else {
                $rules['studNum'] = [
                    'rules'     => 'required|min_length[8]|is_existing_data',
                    'errors'    => [
                        'is_existing_data'  => 'Student number already exist'
                    ]
                ];
                $rules['studEmail'] = [
                    'rules'     => 'required|isUniqueEmail',
                    'errors'    => [
                        'is_UP_mail'    => 'The email you entered is not a valid UP mail',
                        'isUniqueEmail' => 'Email is already taken'
                    ]
                ];
            }
        } elseif ($role === 'admin') {
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
                    'rules'     => 'required|owned_email['.$id.']',
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
                    'rules'     => 'required|isUniqueEmail',
                    'errors'    => [
                        'is_UP_mail'    => 'The email you entered is not a valid UP mail',
                        'isUniqueEmail' => 'Email is already taken'
                    ]
                ];
            }
        } else {
            $rules = [
                'clerkFirstName' => 'required',
                'clerkLastName' => 'required'
            ];
            if(isset($id)) {
                $rules['clerkContactNum'] = [
                    'rules'     => 'required|min_length[11]|is_natural|valid_number|owned_contact['.$id.']',
                    'errors'    => [
                        'uniqueContact' => 'Contact number already exists',
                        'is_natural'   => 'Contact number format: 09xxxxxxxxx',
                        'valid_number' => 'This is not a valid number'
                    ]
                ];
                $rules['clerkEmail'] = [
                    'rules'     => 'required|owned_email['.$id.']',
                    'errors'    => [
                        'is_UP_mail'    => 'The email you entered is not a valid UP mail',
                        'isUniqueEmail' => 'Email is already taken'
                    ]
                ];
            } else {
                $rules['clerkContactNum'] = [
                    'rules'     => 'required|uniqueContact|min_length[11]|is_natural|valid_number',
                    'errors'    => [
                        'uniqueContact' => 'Contact number already exists',
                        'is_natural'   => 'Contact number format: 09xxxxxxxxx',
                        'valid_number' => 'This is not a valid number'
                    ]
                ];
                $rules['clerkEmail'] = [
                    'rules'     => 'required|isUniqueEmail',
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
