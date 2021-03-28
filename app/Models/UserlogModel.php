<?php
namespace App\Models;

use CodeIgniter\Model;

class UserlogModel extends Model {
    protected $table      = 'userlog';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';

    protected $allowedFields = [
        'user_id',
        'ip_address',
        'type',
        'user_token',
        'platform',
        'user_agent',
        'is_deleted'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_on';
    protected $updatedField  = 'updated_on';

    protected $skipValidation = true;
}