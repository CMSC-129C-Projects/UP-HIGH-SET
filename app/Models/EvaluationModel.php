<?php

namespace App\Models;

use CodeIgniter\Model;

class EvaluationModel extends Model {
  protected $table = 'evaluation';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;
  protected $returnType = 'array';

  protected $allowedFields = [
      'name',
      'status',
      'date_start',
      'date_end',
      'year_start',
      'year_end',
      'semester',
      'grading',
      'is_deleted'
  ];

  protected $useTimestamps = true;
  protected $createdField  = 'created_on';
  protected $updatedField  = 'updated_on';

  protected $skipValidation = true;

  /*
  * Fetch the latest evaluation
  */
  public function get_latest_evaluation() {
    $db = \Config\Database::connect();

    $sql = <<<EOT
SELECT id
FROM evaluation
WHERE
	is_deleted = 0
ORDER BY id DESC
LIMIT 1
EOT;

    $query = $db->query($sql);
    return $query->getResult();
  }


  /*
  * Archive Evaluation Sheet
  */
  public function archive_eval_sheet($eval_id) {
    $db = \Config\Database::connect();

    $sql = <<<EOT
UPDATE eval_sheet
SET is_deleted = 1
WHERE
	is_deleted = 0 AND evaluation_id = $eval_id
EOT;

    $query = $db->query($sql);
    return $query;
  }


  /*
  * Archive Evaluation Sheet
  */
  public function archive_eval_answers() {
    $db = \Config\Database::connect();

    $sql = <<<EOT
UPDATE eval_answers
SET is_deleted = 1
WHERE
	is_deleted = 0
EOT;

    $query = $db->query($sql);
    return $query;
  }
}
