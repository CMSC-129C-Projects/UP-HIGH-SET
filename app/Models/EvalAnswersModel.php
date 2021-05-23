<?php
namespace App\Models;

use CodeIgniter\Model;

class EvalAnswersModel extends Model {
  protected $table = 'eval_answers';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;
  protected $returnType = 'array';

  protected $allowedFields = [
      'user_id',
      'question_id',
      'qChoice_id',
      'answer_text',
      'status'
  ];

  protected $useTimestamps = true;
  protected $createdField  = 'created_on';
  protected $updatedField  = 'updated_on';

  protected $skipValidation = true;

  public function getNotNull($eval_sheet_id) {
    $db = \Config\Database::connect();
    $sql =<<<EOT
SELECT id, COUNT(*) as answersTotal
FROM eval_answers
WHERE eval_sheet_id = $eval_sheet_id AND qChoice_id IS NOT NULL
EOT;

    $query = $db->query($sql);
    return $query->getResult();
  }
}
