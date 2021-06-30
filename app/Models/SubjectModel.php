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
        'rating',
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
ON subjects.id = eval_sheet.subject_id
LEFT JOIN faculty
ON subjects.faculty_id = faculty.id
WHERE grade_level = $glevel
    AND eval_sheet.student_id = $studentID
    AND eval_sheet.is_deleted = 0
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
        $query = $db->query($sql);
        return $query->getResult();
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

//   public function get_evaluated_subjects_by_student()
//   {
//     $db = \Config\Database::connect();
//     $sql = <<<EOT
// SELECT
// 	users.id as user_id,
//     CONCAT(users.first_name, " " , users.last_name) as student_name,
//     subjects.id as subject_id,
//     subjects.name as subject_name
// FROM users
// LEFT JOIN subjects
// ON users.grade_level = subjects.grade_level
// LEFT JOIN eval_sheet
// ON eval_sheet.subject_id = subjects.id AND users.id = eval_sheet.student_id
// LEFT JOIN evaluation
// ON eval_sheet.evaluation_id = evaluation.id
// WHERE
// 	users.role = 2 AND users.is_deleted = 0 AND users.is_active = 1
//   AND eval_sheet.status = "Completed" AND evaluation.status = "open"
//   AND subjects.is_deleted = 0 AND eval_sheet.is_deleted = 0
// GROUP BY users.id, subjects.id
// ORDER BY users.id
// EOT;
//
//   $query = $db->query($sql);
//   return $query->getResult();
//   }

    public function get_in_progress_subjects_by_student($id)
    {
        $db = \Config\Database::connect();
        $sql = <<<EOT
SELECT
    subjects.name as subject_name
FROM users
LEFT JOIN subjects
ON users.grade_level = subjects.grade_level
LEFT JOIN eval_sheet
ON eval_sheet.subject_id = subjects.id AND users.id = eval_sheet.student_id
LEFT JOIN evaluation
ON eval_sheet.evaluation_id = evaluation.id
WHERE
    users.role = 2 AND users.id = $id
    AND eval_sheet.status != "Completed" AND evaluation.status = "open"
    AND users.is_deleted = 0 AND users.is_active = 1
    AND subjects.is_deleted = 0 AND eval_sheet.is_deleted = 0
EOT;

        $query = $db->query($sql);
        return $query->getResult();
    }

    public function get_final_rating()
    {
        $db = \Config\Database::connect();
        $sql = <<<EOT
SELECT faculty.*, AVG(rating) as final_rating
FROM subjects
LEFT JOIN faculty
ON subjects.faculty_id = faculty.id
WHERE subjects.is_deleted = 0 AND faculty.is_deleted = 0
GROUP BY faculty_id
ORDER BY final_rating
EOT;
        $query = $db->query($sql);
        return $query->getResult();
    }
    
    public function get_subjects_by_gradelevel($gradelevel)
    {
        $db = \Config\Database::connect();
        $sql = <<<EOT
SELECT *
FROM subjects
WHERE grade_level = $gradelevel
EOT;
        $query = $db->query($sql);
        return $query->getResult();
    }

    /**
     * Number of students who submitted the evaluation sheet per subject
     */
    public function get_subjects_complete_count($subject_id = null)
    {
        $db = \Config\Database::connect();
        $sql = <<<EOT
SELECT subjects.id, subjects.name, IFNULL(counts.student_count, 0) as complete_count
FROM subjects
LEFT JOIN (SELECT eval_sheet.subject_id, COUNT(eval_sheet.subject_id) as student_count
            FROM eval_sheet
            LEFT JOIN users
            ON eval_sheet.student_id = users.id
            WHERE eval_sheet.status = 'Completed'
                AND users.is_active = 1
                AND users.is_deleted = 0
            GROUP BY eval_sheet.subject_id) as counts
ON subjects.id = counts.subject_id
WHERE subjects.is_deleted = 0
EOT;

        if (isset($subject_id)) {
            $continuation = <<<EOT
AND subjects.id = $subject_id
EOT;
            $sql = $sql . ' ' . $continuation;
        }

        $query = $db->query($sql);
        return $query->getResult();
    }
}
