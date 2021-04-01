<?php
namespace App\Entities;

use \CodeIgniter\Entity;

class Account extends Entity {
    protected $attributes = [
        'first_name' => null,
        'last_name' => null,
        'role' => null,
        'contact_num' => null,
        'username' => null,
        'email' => null,
        'password' => null,
        'is_active' => null,
        'is_deleted' => null
    ];
}