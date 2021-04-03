<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailModel extends Model {
  protected $table = 'emails';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;
  protected $returnType           = 'array';

  protected $allowedFields = [
      'title',
      'message',
      'purpose',
      'is_deleted'
  ];

  protected $useTimestamps = true;
  protected $createdField  = 'created_on';
  protected $updatedField  = 'updated_on';

  protected $skipValidation = true;
}
