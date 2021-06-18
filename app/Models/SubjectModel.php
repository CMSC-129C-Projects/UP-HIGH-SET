<?php
namespace App\Models;

use CodeIgniter\Model;

class SubjectModel extends Model {
    protected $table      = 'subjects';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    // protected $returnType = 'App\Entities\Userlog';
    protected $returnType = 'array';

    protected $allowedFields = [
        'faculty_id',
        'grade_level',
        'name',
        'is_deleted'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_on';
    protected $updatedField  = 'updated_on';

    protected $skipValidation = true;

    public function get_subjects_taken($studentID, $glevel)
    {
        $db = \Config\Database::connect();

        $sql = <<<EOT
SELECT *, eval_sheet.id as eval_sheet_id
FROM subjects
LEFT JOIN eval_sheet
ON subjects.id = eval_sheet.subject_id AND eval_sheet.student_id = $studentID AND eval_sheet.is_deleted = 0
LEFT JOIN faculty
ON subjects.faculty_id = faculty.id
WHERE grade_level = $glevel
    AND subjects.is_deleted = 0
EOT;

        $query = $db->query($sql);
        return $query->getResult();
    }

    public function get_subjects_by_faculty($facultyID)
    {
        $db = \Config\Database::connect();

        $sql = <<<EOT
SELECT subs.*, CASE WHEN u.id IS NOT NULL 
    THEN COUNT(subs.grade_level)
    ELSE 0
END  as total_students
FROM (SELECT *
    FROM subjects as s
    WHERE s.faculty_id = $facultyID
    AND s.is_deleted = 0) as subs
LEFT JOIN users as u
ON subs.grade_level = u.grade_level
AND u.is_active = 1
AND u.is_deleted = 0
GROUP BY subs.grade_level
EOT;
    }

  public function get_total_subjects_by_glevel()
  {
    $db = \Config\Database::connect();
    $sql = <<<EOT
SELECT grade_level, COUNT(id) as total
FROM subjects
WHERE is_deleted = 0
GROUP BY grade_level
EOT;

    $query = $db->query($sql);
    return $query->getResult();
  }
}
