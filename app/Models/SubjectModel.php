<?php

namespace App\Models;

use CodeIgniter\Model;

class SubjectModel extends Model {
  protected $table = 'subjects';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;
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
