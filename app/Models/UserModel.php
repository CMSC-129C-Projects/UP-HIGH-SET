<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'App\Entities\Account';

    protected $allowedFields = [
        'allow_verify',
        'student_num',
        'first_name',
        'last_name',
        'role',
        'grade_level',
        'contact_num',
        'username',
        'email',
        'password',
        'password_updated',
        'avatar_url',
        'is_active',
        'is_deleted'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_on';
    protected $updatedField  = 'updated_on';

    protected $skipValidation = true;

    public function getSubjects($id)
    {
        if(!isset($id)) {
            return false;
        }

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
        return $query->getResult();
    }
    
    public function get_all_students_per_subject($id)
    {
        $db = \Config\Database::connect();

        $sql = <<<EOT
SELECT count(users.id) as student_perSub
FROM users
LEFT JOIN subjects
ON users.grade_level = subjects.grade_level
WHERE
users.is_deleted = 0 AND users.is_active = 1 AND
users.role = 2 AND subjects.is_deleted = 0 AND
subjects.id = $id
EOT;

        $query = $db->query($sql);
        $result = $query->getResult();

        return $result[0]->student_perSub;
    }

    /**
     * Get Number Of Students
     * That Have Completed
     * Evaluating
     */
    public function get_students_complete_count()
    {
        $db = \Config\Database::connect();

        $sql = <<<EOT
SELECT u.id, u.first_name, u.last_name, u.grade_level, IFNULL(completes.total, 0) as 'count'
FROM users as u
LEFT JOIN (SELECT u.id, COUNT(u.id) as total
        FROM users as u
        LEFT JOIN eval_sheet as es
        ON u.id = es.student_id
        WHERE es.is_deleted = 0 AND u.is_active = 1 AND u.is_deleted = 0 AND es.status = 'Completed'
        GROUP BY u.id) AS completes
ON completes.id = u.id
WHERE u.role = '2'
EOT;
        $query = $db->query($sql);
        return $query->getResult();
    }

    /*
    * Update Grade Level
    */
    public function update_grade_level($grade_level, $higher_level)
    {
      $db = \Config\Database::connect();

      $sql = <<<EOT
UPDATE users
SET grade_level = $higher_level
WHERE grade_level = $grade_level AND is_active = 1
AND is_deleted = 0 AND role = 2
EOT;

        $query = $db->query($sql);
        return $query;
    }
}
