<?php

namespace App\Controllers;
use App\Models\LoginModel;

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
        'password' => 'required|validateUser[email, password]'
      ];

      $errors = [
        'password' => [
            'validateUser' => "Email and Password don't match",
        ],
      ];

      if($this->validate($rules, $errors)){

        $model = new LoginModel();
        $user = $model->where('email', $this->request->getVar('email'))->first();

        $this->setSession($user);
        return redirect()->to(base_url('dashboard'));

      } else {
        $data['validation'] = $this->validator;
      }
    }

    return view('user_mgt/login', $data);
	}

  public function setSession($user)
  {
    $session_data = [
      'email' => $user['email'],
      'password' => $user['password'],
      'isLoggedIn' => true,
    ];

    session()->set('logged_user', $session_data);
    return true;
  }

  public function logout(){
    session()->remove('logged_user');
    session()->destroy();
    return redirect()->to('login');
  }
}
