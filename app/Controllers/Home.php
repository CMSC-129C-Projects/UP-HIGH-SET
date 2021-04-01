<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$css = ['custom/login/login.css'];
        // $js = ['custom/alert.js'];
        // $data['js'] = addExternal($js, 'javascri
		$data = [
			'validation'=> null,
			'css'		=> addExternal($css, 'css'),
			'isLogin'	=> true
		];
    	return view('login/login', $data);
	}
}
