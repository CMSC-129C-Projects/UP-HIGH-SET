<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'App\Entities\Student';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'student_num',
        'first_name',
        'last_name',
        'role',
        'grade_level',
        'contact_num',
        'username',
        'email',
        'password',
        'is_active'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_on';
    protected $updatedField  = 'updated_on';
    protected $deletedField  = 'is_deleted';

    protected $skipValidation = true;
}