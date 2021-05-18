<?php

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
