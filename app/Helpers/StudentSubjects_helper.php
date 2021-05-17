<?php

function fetch_stud_subjects($id = null) {
  if(isset($id)) {
    $db = \Config\Database::connect();

    $sql =<<<EOT
SELECT
users.grade_level ,
subjects.faculty_id,
subjects.name
FROM users
LEFT JOIN subjects
ON users.grade_level = subjects.grade_level
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
        'faculty_id' => $r->faculty_id
      ];
      $subjects[] = $data;
    }
    return $subjects;
  }
  
  return false;
}
