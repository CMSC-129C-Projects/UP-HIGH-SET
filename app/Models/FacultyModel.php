<?php
namespace App\Models;

use CodeIgniter\Model;

class FacultyModel extends Model {
    protected $table      = 'faculty';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    // protected $returnType = 'App\Entities\Userlog';
    protected $returnType = 'array';

    protected $allowedFields = [
        'first_name',
        'last_name',
        'details',
        'is_deleted'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_on';
    protected $updatedField  = 'updated_on';

    protected $skipValidation = true;
}