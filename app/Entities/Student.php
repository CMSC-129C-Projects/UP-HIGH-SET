<?php
namespace App\Entities;

class Student extends Account {
    function __construct() {
        $this->attributes['student_num'] = null;
        $this->attributes['grade_level'] = null;
        $this->attributes['avatar_url'] = null;
    }
}