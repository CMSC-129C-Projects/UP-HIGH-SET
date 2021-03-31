<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
    $data = [];

    if($this->request->getMethod() == 'post')
    {
      $rules = [
        'email' => 'required|valid_email',
        'password' => 'required'
      ];

      if($this->validate($rules)){
        $data['validation'] = null;
      } else {
        $data['validation'] = $this->validator;
      }
    }

    return view('user_mgt/login', $data);
	}
}
