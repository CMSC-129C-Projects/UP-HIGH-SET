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
        } elseif($userModel->where('student_num', $str)) {
            return false;
        } else {
            return true;
        }
    }

    public function is_UP_mail(string $str): bool {
        return strpos($str, '@up.edu.ph') !== false;
    }
}