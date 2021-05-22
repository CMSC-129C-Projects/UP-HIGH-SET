<?php

namespace App\Models;

use CodeIgniter\Model;

class SecSheetModel extends Model {
  protected $table = 'sheet_section';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;
  protected $returnType = 'array';

  protected $allowedFields = [
      'eval_sheet_id',
      'eval_section_id',
      'is_deleted'
  ];

  protected $useTimestamps = true;
  protected $createdField  = 'created_on';
  protected $updatedField  = 'updated_on';

  protected $skipValidation = true;
}
