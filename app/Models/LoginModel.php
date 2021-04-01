<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model {

	protected $table                = 'users';
	protected $primaryKey           = 'id';

	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;

	protected $allowedFields        = [
		"email",
		"password"
	];

  protected $useTimestamps = true;
  protected $createdField  = 'created_on';
  protected $updatedField  = 'updated_on';

  protected $skipValidation = true;
}
