<?php
namespace App\Models;

use CodeIgniter\Model;

class EvalSheetModel extends Model {
  protected $table = 'eval_sheet';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;
  protected $returnType = 'array';

  protected $allowedFields = [
      'evaluation_id',
      'student_id',
      'subject_id',
      'rating',
      'status',
      'is_deleted'
  ];

  protected $useTimestamps = true;
  protected $createdField  = 'created_on';
  protected $updatedField  = 'updated_on';

  protected $skipValidation = true;


  public function getUnfinishedStudents($subjectID)
  {
    if(!isset($subjectID)) {
      return false;
    }

    $db = \Config\Database::connect();
    $sql =<<<EOT
SELECT id, status, student_id
FROM eval_sheet
WHERE subject_id = $subjectID AND (status = 'Open' OR status = 'Inprogress')
EOT;

    $query = $db->query($sql);
    return $query->getResult();
  }
}
