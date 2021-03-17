<?php
namespace App\Entities;

class Student extends Account {
    function __construct() {
        $this->attributes['student_num'] = null;
        $this->datamap['student_num'] = 'student_num';
        
        $this->attributes['grade_level'] = null;
        $this->datamap['grade_level'] = 'grade_level';
    }
}