<?php
namespace App\Controllers;

use \App\Entities\Admin;

class Test extends BaseController
{
    public function index() {
        return view('Student Dashboard');
    }
}