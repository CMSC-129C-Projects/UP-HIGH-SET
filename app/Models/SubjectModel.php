<?php

namespace App\Models;

use CodeIgniter\Model;

class SubjectModel extends Model {
  protected $table = 'subjects';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;
  protected $returnType = 'array';

  protected $allowedFields = [
      'faculty_id',
      'grade_level',
      'name',
      'is_deleted'
  ];

  protected $useTimestamps = true;
  protected $createdField  = 'created_on';
  protected $updatedField  = 'updated_on';

  protected $skipValidation = true;
}
