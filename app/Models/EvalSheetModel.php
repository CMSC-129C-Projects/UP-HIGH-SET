<?php
namespace App\Models;

use CodeIgniter\Model;

class EvalSheetModel extends Model {
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'App\Entities\Account';

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

    public function get_all_students_who_evaluated($id) {
      $db = \Config\Database::connect();

      $sql = <<<EOT
SELECT count(eval_sheet.student_id) as students_evaluated
FROM eval_sheet
LEFT JOIN subjects
ON eval_sheet.subject_id = subjects.id
LEFT JOIN evaluation
ON eval_sheet.evaluation_id = evaluation.id
WHERE
eval_sheet.status = "Completed" AND eval_sheet.is_deleted = 0 AND
evaluation.status = "Open" AND evaluation.is_deleted = 0 AND
eval_sheet.subject_id = $id
EOT;

      $query = $db->query($sql);
      $result = $query->getResult();

      return $result[0]->students_evaluated;
  }
}
