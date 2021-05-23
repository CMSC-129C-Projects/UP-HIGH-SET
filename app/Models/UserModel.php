<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'App\Entities\Account';

    protected $allowedFields = [
        'student_num',
        'first_name',
        'last_name',
        'role',
        'grade_level',
        'contact_num',
        'username',
        'email',
        'password',
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
    
    public function get_all_students_per_subject($id) {
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
}
