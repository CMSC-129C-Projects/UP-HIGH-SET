<?php

namespace App\Controllers;
use App\Models\LoginModel;

class Home extends BaseController
{
	public function index()
	{
    $data['validation'] = null;

    if($this->request->getMethod() == 'post')
    {
      $rules = [
        'email' => 'required|valid_email',
        'password' => 'required'
      ];

      if($this->validate($rules)){
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // echo $email . ": " . $password;
      } else {
        $data['validation'] = $this->validator;
      }
    }

    return view('user_mgt/login', $data);
	}
}
