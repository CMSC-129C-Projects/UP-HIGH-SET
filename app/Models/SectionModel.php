<?php

namespace App\Models;

use CodeIgniter\Model;

class SectionModel extends Model {
  protected $table = 'eval_section';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;
  protected $returnType = 'array';

  protected $allowedFields = [
      'sec_order',
      'name',
      'question_type_id',
      'is_deleted'
  ];

  protected $useTimestamps = true;
  protected $createdField  = 'created_on';
  protected $updatedField  = 'updated_on';

  protected $skipValidation = true;

  public function getQuestions($eval_question_section_id) {
    $db = \Config\Database::connect();
    
    $sql = <<<EOT
SELECT eval_question.id as id, eval_question.question_text
FROM eval_section
LEFT JOIN eval_question ON eval_question.section_id = eval_section.id
WHERE eval_question.is_deleted = 0 and eval_question.section_id = $eval_question_section_id
ORDER BY eval_question.question_order ASC
EOT;

      $query = $db->query($sql);
      return $query->getResult();
  }

  public function get_eval_sections_by_type($question_type_id)
  {
    $db = \Config\Database::connect();

    $sql = <<<EOT
SELECT id
FROM eval_section
WHERE question_type_id = $question_type_id
EOT;

    $query = $db->query($sql);
    return $query->getResult();
  }

  public function get_ids()
  {
      $db = \Config\Database::connect();

    $sql = <<<EOT
SELECT id
FROM eval_section
WHERE is_deleted = 0
EOT;

      $query = $db->query($sql);
      return $query->getResult();
  }
}
