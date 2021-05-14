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
}
