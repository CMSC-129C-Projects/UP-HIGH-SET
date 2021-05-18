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
}
