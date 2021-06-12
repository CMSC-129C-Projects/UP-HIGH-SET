<?php

use App\Models\SubjectModel;
use App\Models\FacultyModel;
use App\Models\UserModel;

function fetch_stud_subjects($id = null) {
  if(isset($id)) {
    $db = \Config\Database::connect();

    $sql =<<<EOT
SELECT
users.grade_level ,
faculty.first_name,
faculty.last_name,
faculty.details,
subjects.name
FROM users
LEFT JOIN subjects
ON users.grade_level = subjects.grade_level
LEFT JOIN faculty
on subjects.faculty_id = faculty.id
WHERE
subjects.is_deleted = 0 AND users.role = 2
AND users.is_active = 1
AND users.id = $id
ORDER BY subjects.name ASC
EOT;

    $query = $db->query($sql);
    $result = $query->getResult();

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

function fetch_student_via_model($id = null) {
  if(isset($id)) {

    $subjectModel = new SubjectModel();
    $facultyModel = new FacultyModel();
    $userModel = new UserModel();

    $user = $userModel->where('id', $id)->first();
    $subjects = $subjectModel->where('grade_level', $user->grade_level)->findAll();
    $faculty_id = $subjects[0]['faculty_id'];
    $faculty = $facultyModel->where('id', $faculty_id)->findAll();

    $data= [
      'grade_level' => $user->grade_level,
      'subjects' => $subjects, // array
      'faculties' => $faculty // array
    ];

    return $data;
  }
    return false;
}
