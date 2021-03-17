<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
    	echo send_acc_notice();
	}
}
