<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model {

  protected $DBGroup              = 'default';
	protected $table                = 'users';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
    "student_num",
    // "frst_name",
    // "last_name",
		// "role",
    // "grade_level",
    // "contact_num",
    "username",
		"email",
		"password" //,
    // "is_active"
	];
}
