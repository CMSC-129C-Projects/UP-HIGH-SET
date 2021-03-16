<?php
namespace App\Entities;

class Admin extends Account {
    public function addStudent($request) {
        $newStudent = new \App\Entities\Student();
        $userModel = new \App\Models\UserModel();

        $newStudent->
    }

    public function updateStudent() {

    }

    public function deleteStudent() {
        
    }
}