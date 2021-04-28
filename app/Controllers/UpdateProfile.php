<?php
namespace App\Controllers;

use \App\Entities\Admin;


class UpdateProfile extends BaseController
{
    public function index() {
        $data['role'] = null;
        return view("account_updates/profileUpdate", $data);
    }
}
