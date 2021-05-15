<?php

public function fetch_stud_subjects($email == null) {
  if(isset($email)) {
    $db = \Config\Database::connect();

    $sql =<<<EOT
SELECT users.grade_level as grLevel, subjects.faculty_id as faculty_id, subjects.name as name
FROM users
LEFT JOIN subjects
ON users.grade_level = subjects.grade_level
WHERE
	subjects.is_deleted = 0 AND users.role = 2
    AND users.is_active = 1
    AND users.email = $email
ORDER BY subjects.name
ASC
EOT;

    $query = $db->query($sql);
    $result = $query

    $data = [
      'grade_level' = $result['grLevel'],
      'subject_name' = $result['name'],
      'faculty_id' = $result['faculty_id']
    ];
  }
  return $data;
}
