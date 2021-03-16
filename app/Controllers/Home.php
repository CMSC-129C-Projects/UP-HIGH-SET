<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		helper('accountnotice');
    echo send_acc_notice();
	}
}
