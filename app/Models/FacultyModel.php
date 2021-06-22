<?php
namespace App\Models;

use CodeIgniter\Model;

class FacultyModel extends Model {
    protected $table      = 'faculty';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    // protected $returnType = 'App\Entities\Userlog';
    protected $returnType = 'array';

    protected $allowedFields = [
        'first_name',
        'last_name',
        'details',
        'is_deleted'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_on';
    protected $updatedField  = 'updated_on';

    protected $skipValidation = true;

    public function searchFaculty($searchFirstName, $searchLastName)
    {
        $db = \Config\Database::connect();

        $sql = <<<EOT
SELECT *
FROM faculty
WHERE (first_name LIKE '%$searchFirstName%' OR last_name LIKE '%$searchLastName%')
AND is_deleted = 0;
EOT;

        $query = $db->query($sql);

        return $query->getResult();
    }

    public function get_subjects_handled($id)
    {
      $db = \Config\Database::connect();

      $sql = <<<EOT
SELECT
  subjects.id,
  subjects.name,
  CONCAT(faculty.first_name, " " , faculty.last_name) as faculty_name
FROM subjects
LEFT JOIN faculty
ON subjects.faculty_id = faculty.id
WHERE
  faculty.id = $id AND faculty.is_deleted = 0
  AND subjects.is_deleted = 0
EOT;

      $query = $db->query($sql);

      return $query->getResult();
    }

}
