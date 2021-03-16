<?php

namespace App\Controllers;

class Update extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}

    public function add()
    {
        $admin = new \App\Entities\Admin();
        $admin.add($this->request);
    }
}
