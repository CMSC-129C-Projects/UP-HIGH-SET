<?php
namespace App\Controllers;

class Update extends BaseController
{
    protected $admin;

    function __construct() {
        $admin = new \App\Entities\Admin();
    }

	public function index() {
		return view('welcome_message');
	}

    public function add() {
        $admin.addStudent($this->request);
    }

    public function edit() {
        $admin.editStudent($this->request);
    }
}
