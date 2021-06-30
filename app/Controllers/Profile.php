<?php
namespace App\Controllers;

use \App\Entities\Admin;
use \App\Entities\Student;
use \App\Models\UserModel;

class Profile extends BaseController
{
    protected $userModel;

    public function _remap($method, $param = null)
    {
        $this->hasSession();
        switch($method)
        {
            case 'student':
                $this->role_checking(['1','3']);
            case 'admin':
                $this->role_checking(['2','3']);
            case 'clerk':
                $this->role_checking(['1','2']);
                return $this->$method();
                break;
            default:
                return redirect()->to(base_url('dashboard'));
        }
    }

    function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function student()
    {
        $role = $_SESSION['logged_user']['role'];

        $sessionStudent = new Student();

        $sessionStudent = $this->userModel->where('is_deleted', 0)->where('email', $_SESSION['logged_user']['email'])->first();

        $data = $this->setDefaultData($role, $sessionStudent->id);

        $css = ['custom/profileUpdate/pUpdate.css', 'custom/alert.css', 'custom/avatar.css'];
        $js = ['custom/profileUpdate/pUpdate.js', 'custom/alert.js', 'custom/avatar.js'];
        $data['js'] = addExternal($js, 'javascript');
        $data['css'] = addExternal($css, 'css');

        $data['validation'] = null;
        $data['status'] = null;
        $data['role'] = $role;
        // $data['id'] = $id;

        if($this->request->getMethod() == 'post') {
            if($this->validate($this->setRules($role, $sessionStudent->id))) {
                $values = [
                    'contact_num' => $this->request->getPost('mobile'),
                    'username'    => $this->request->getPost('username'),
                    'avatar_url'  => $this->request->getPost('avatar')
                ];
                $data['status'] = ($this->userModel->update($sessionStudent->id, $values)) ? true : false;
            } else {
                $data['validation'] = $this->validator;
            }
        }
        $data['status'] = $data['status'] ? 'true' : (isset($data['status']) ? 'false' : null);

        $data['role'] = '2';

        return view("account_updates/profileUpdate", $data);
    }

    public function admin()
    {
        $role = $_SESSION['logged_user']['role'];

        $sessionAdmin = new Admin();

        $sessionAdmin = $this->userModel->asObject('App\Entities\Admin')->where('is_deleted', 0)->where('role', $role)->where('email', $_SESSION['logged_user']['email'])->first();

        $data = $this->setDefaultData($role, $sessionAdmin->id);

        $css = ['custom/profileUpdate/pUpdate.css', 'custom/alert.css', 'custom/avatar.css'];
        $js = ['custom/profileUpdate/pUpdate.js', 'custom/alert.js', 'custom/avatar.js'];
        $data['js'] = addExternal($js, 'javascript');
        $data['css'] = addExternal($css, 'css');

        $data['validation'] = null;
        $data['status'] = null;
        $data['role'] = $role;
        // $data['id'] = $id;

        if($this->request->getMethod() == 'post') {
            if($this->validate($this->setRules($role, $sessionAdmin->id))) {
                $email = $this->request->getPost('email') . '@up.edu.ph';
                $values = [
                    'avatar_url'  => $this->request->getPost('avatar'),
                    'contact_num' => $this->request->getPost('mobile'),
                    'username'    => $this->request->getPost('username'),
                    'first_name'  => $this->request->getPost('first_name'),
                    'last_name'   => $this->request->getPost('last_name'),
                    'email'       => $email
                ];
                if ($this->userModel->update($sessionAdmin->id, $values)) {
                    $data['status'] = true;
                    $_SESSION['logged_user']['first_name'] = $values['first_name'];
                    $_SESSION['logged_user']['last_name'] = $values['last_name'];
                    $_SESSION['logged_user']['avatar_url'] = $values['avatar_url'];
                    $_SESSION['logged_user']['email'] = $values['email'];
                } else {
                    $data['status'] = false;
                }
                return redirect()->to(base_url('profile/admin/true'));
            } else {
                $data['validation'] = $this->validator;
            }
        }
        $data['status'] = $data['status'] ? 'true' : (isset($data['status']) ? 'false' : null);
        
        $data['role'] = '1';

        return view("account_updates/adminProfileUpdate", $data);
    }

    public function clerk()
    {
        $role = $_SESSION['logged_user']['role'];

        $sessionAdmin = new Admin();

        $sessionAdmin = $this->userModel->asObject('App\Entities\Admin')->where('is_deleted', 0)->where('role', $role)->where('email', $_SESSION['logged_user']['email'])->first();

        $data = $this->setDefaultData($role, $sessionAdmin->id);

        $css = ['custom/profileUpdate/pUpdate.css', 'custom/alert.css', 'custom/avatar.css'];
        $js = ['custom/profileUpdate/pUpdate.js', 'custom/alert.js', 'custom/avatar.js'];
        $data['js'] = addExternal($js, 'javascript');
        $data['css'] = addExternal($css, 'css');

        $data['validation'] = null;
        $data['status'] = null;
        $data['role'] = $role;
        // $data['id'] = $id;

        if($this->request->getMethod() == 'post') {
            if($this->validate($this->setRules($role, $sessionAdmin->id))) {
                $email = $this->request->getPost('email') . '@up.edu.ph';
                $values = [
                    'avatar_url'  => $this->request->getPost('avatar'),
                    'contact_num' => $this->request->getPost('mobile'),
                    'username'    => $this->request->getPost('username'),
                    'first_name'  => $this->request->getPost('first_name'),
                    'last_name'   => $this->request->getPost('last_name'),
                    'email'       => $email
                ];
                $_SESSION['logged_user']['first_name'] = $values['first_name'];
                $_SESSION['logged_user']['last_name'] = $values['last_name'];
                $_SESSION['logged_user']['avatar_url'] = $values['avatar_url'];
                $_SESSION['logged_user']['email'] = $values['email'];
                
                $data['status'] = ($this->userModel->update($sessionAdmin->id, $values)) ? true : false;
                return redirect()->to(base_url('profile/clerk/true'));
            } else {
                $data['validation'] = $this->validator;
            }
        }
        $data['status'] = $data['status'] ? 'true' : (isset($data['status']) ? 'false' : null);
        
        $data['role'] = '1';

        return view("account_updates/clerkProfileUpdate", $data);
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
            $data['avatar_url'] = $student->avatar_url;
            $data['email'] = str_replace('@up.edu.ph', '', $student->email);
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
            $data['eml'] = str_replace('@up.edu.ph', '', $adminUpdate->email);
            $data['avatar_url'] = $adminUpdate->avatar_url;
        }

        return $data;
    }

    protected function setRules($role = null, $id = null) {
        if($role == '2') {
            $rules['username'] = [
                'rules'     => 'uniqueUsername['. $id .']',
                'errors'    => [
                    'uniqueUsername'  => 'Username already taken'
                ]
            ];
            $rules['mobile'] = [
                'rules'     => 'valid_number',
                'errors'    => [
                    'valid_number' => 'Contact number format: 09xxxxxxxxx'
                ]
            ];
        } else {
            $rules = [
                'first_name' => 'required',
                'last_name' => 'required'
            ];
            $rules['mobile'] = [
                'rules'     => 'required|min_length[11]|is_natural|valid_number|owned_contact['.$id.']',
                'errors'    => [
                    'owned_contact' => 'Contact number already exists',
                    'is_natural'   => 'Contact number format: 09xxxxxxxxx',
                    'valid_number' => 'This is not a valid number'
                ]
            ];
            $rules['email'] = [
                'rules'     => 'required|owned_email['.$id.']',
                'errors'    => [
                    'owned_email' => 'Email is already taken'
                ]
            ];
        }

        return $rules;
    }
}