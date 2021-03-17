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

    protected $datamap = [
        'first_name' => 'first_name',
        'last_name' => 'last_name',
        'role' => 'role',
        'contact_num' => 'contact_num',
        'username' => 'username',
        'email' => 'email',
        'password' => 'password',
        'is_active' => 'is_active',
        'is_deleted' => 'is_deleted'
    ];
}