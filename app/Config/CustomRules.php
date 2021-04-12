<?php
namespace Config;

class CustomRules {
    public function valid_number(string $str): bool {
        return $str[0] == '0' && $str[1] == '9';
    }

    public function is_existing_data(string $str): bool {
        $userModel = new \App\Models\UserModel();

        if($userModel->where('student_num', $str)->first()) {
            return false;
        } else {
            return true;
        }
    }

    public function owned_student_number(string $str, string $fields, array $data): bool {
        $userModel = new \App\Models\UserModel();

        $student = new \App\Entities\Student();

        $fields = (int)$fields;
        $student = $userModel->find($fields);

        if($str == $student->student_num) {
            return true;
        } elseif($userModel->where('student_num', $str)->findAll()) {
            return false;
        } else {
            return true;
        }
    }

    public function owned_email(string $str, string $fields, array $data): bool {
        $userModel = new \App\Models\UserModel();

        $student = new \App\Entities\Student();

        $fields = (int)$fields;
        $student = $userModel->find($fields);

        if($str == $student->email) {
            return true;
        } elseif($userModel->where('email', $str)->findAll()) {
            return false;
        } else {
            return true;
        }
    }

    public function owned_contact(string $str, string $fields, array $data): bool {
        $userModel = new \App\Models\UserModel();

        $student = new \App\Entities\Admin();

        $fields = (int)$fields;
        $student = $userModel->find($fields);

        if($str == $student->contact_num) {
            return true;
        } elseif($userModel->where('contact_num', $str)->findAll()) {
            return false;
        } else {
            return true;
        }
    }

    public function is_UP_mail(string $str): bool {
        return strpos($str, '@up.edu.ph') !== false;
    }

    public function uniqueContact(string $str): bool {
        $userModel = new \App\Models\UserModel();

        $admins = $userModel->where('role', '1')->where('contact_num', $str)->findAll();
        return (count($admins) === 0);
    }

    public function isUniqueEmail(string $str): bool {
        $userModel = new \App\Models\UserModel();

        $user = $userModel->asArray()->where('email', $str)->findAll();

        return (count($user) === 0);
    }

    public function validateUser(string $str, string $fields, array $data){
        $model = new \App\Models\UserModel();
        $user = $model->asArray()->where('email', $data['email'])->first();
    
        if(!$user)
          return false;
    
        return password_verify($data['password'], $user['password']);
    }
}
