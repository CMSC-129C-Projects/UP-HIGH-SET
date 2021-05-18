<?php

use App\Models\SubjectModel;
use App\Models\FacultyModel;
use App\Models\UserModel;

function fetch_stud_subjects($id = null) {
    $userModel = new UserModel();
    $result = $userModel->getSubjects($id);
    $subjects = array();

    foreach ($result as $r) {
      $data= [
        'grade_level' => $r->grade_level,
        'subject_name' => $r->name,
        'faculty_fName' => $r->first_name,
        'faculty_lName' => $r->last_name,
        'faculty_details' => $r->details
      ];
      $subjects[] = $data;
    }
    return $subjects;
  }

  return false;
}