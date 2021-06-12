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
}
