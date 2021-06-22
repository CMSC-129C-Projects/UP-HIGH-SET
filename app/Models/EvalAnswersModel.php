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
      'eval_sheet_id',
      'question_id',
      'qChoice_id',
      'answer_text',
      'status'
  ];

  protected $useTimestamps = true;
  protected $createdField  = 'created_on';
  protected $updatedField  = 'updated_on';

  protected $skipValidation = true;

  /**
   * Get previous answers
   * which are not null
   */
  public function getNotNull($eval_sheet_id)
  {
    $db = \Config\Database::connect();
    $sql =<<<EOT
SELECT id, COUNT(*) as answersTotal
FROM eval_answers
WHERE eval_sheet_id = $eval_sheet_id AND qChoice_id IS NOT NULL
EOT;

    $query = $db->query($sql);
    return $query->getResult();
  }

  /**
   * Get Answers Per Sheet
   */
  public function get_answers_per_sheet($eval_sheet_id, $user_id)
  {
    $db = \Config\Database::connect();

    $sql = <<<EOT
SELECT eq.section_id, ea.*
FROM eval_answers as ea
LEFT JOIN eval_question as eq
ON eq.id = ea.question_id
WHERE user_id = $user_id AND eval_sheet_id = $eval_sheet_id
EOT;

    $query = $db->query($sql);
    return $query->getResult();
  }

  /**
   * Get open ended q&a
   */
  public function get_open_ended($eval_sheet_id, $user_id)
  {
    $db = \Config\Database::connect();

    $sql = <<<EOT
SELECT eq.question_text, ea.*
FROM eval_question as eq
LEFT JOIN eval_answers as ea
ON eq.id = ea.question_id
WHERE eq.section_id = 6
	AND ea.user_id = $user_id
  AND ea.eval_sheet_id = $eval_sheet_id
EOT;

    $query = $db->query($sql);
    return $query->getResult();
  }
}
