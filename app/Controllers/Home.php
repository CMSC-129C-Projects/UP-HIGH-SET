<?php

namespace App\Controllers;
// use App\Models\LoginModel;

class Home extends BaseController
{

  public function index() {
    return redirect()->to(base_url('home/login'));
  }

	public function login()
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

      } else {
        $data['validation'] = $this->validator;
      }
    }

    return view('user_mgt/login', $data);
	}
}
