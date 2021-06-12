<?php
namespace App\Models;

use CodeIgniter\Model;

class EvalquestionModel extends Model {
  protected $table = 'eval_question';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;
  protected $returnType = 'array';

  protected $allowedFields = [
      'section_id',
      'question_order',
      'question_text',
      'is_deleted'
  ];

  protected $useTimestamps = true;
  protected $createdField  = 'created_on';
  protected $updatedField  = 'updated_on';

  protected $skipValidation = true;


  public function getNumberOfQuestions()
  {
    $db = \Config\Database::connect();
    $sql =<<<EOT
SELECT COUNT(id) as size
FROM eval_question
WHERE is_deleted = 0
EOT;

    $query = $db->query($sql);
    return $query->getResult();
  }
}
