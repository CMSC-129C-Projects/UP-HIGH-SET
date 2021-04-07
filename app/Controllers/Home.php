<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;
use App\Models\UserlogModel;
use App\Models\UserModel;

use \App\Entities\Userlog;

class Home extends BaseController
{
	public function index() {
		return redirect()->to(base_url('login'));
	}

	public function login()
	{

		if ($this->session->has('logged_user')) {
			return redirect()->to(base_url('dashboard'));
		}

		$data['validation'] = null;
    $data['error'] = null;
		$css = ['custom/login/login.css'];
		$data['css'] = addExternal($css, 'css');

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

				if($user['is_active'] != 1 || $user['is_deleted'] != 0) {
					$data['error'] = 'The account your trying to access is either inactive or deleted. <br> Please contact your school clerk if you wish to reactivate it.';
					return view('user_mgt/login', $data);
				} else {
					$this->updateUserlog($user['id']);
					$this->setSession($user);
					return redirect()->to(base_url('dashboard'));
				}
			} else {
				$data['validation'] = $this->validator;
			}
		}

		return view('user_mgt/login', $data);
	}

  public function forgot_password()
  {
    $data = [];
		$data['validation'] = null;
    $css = ['custom/login/login.css'];
    $data['css'] = addExternal($css, 'css');

    if($this->request->getMethod() == 'post'){

      $rules = ['email_fpass' => 'required|valid_email|is_UP_mail'];

      $errors = [
				'email_fpass' => [
          'is_UP_mail'  => 'The email you entered is an invalid UP mail',
          'valid_email' => 'You have entered an invalid email'
        ]
      ];

      if($this->validate($rules, $errors)) {
        // $model = new UserModel();
				// $user = $model->where('email', $this->request->getVar('email'))->first();
        //
				// if($user['is_active'] != 1 || $user['is_deleted'] != 0) {
				// 	$data['error'] = 'The account your trying to access is either inactive or deleted. <br> Please contact your school clerk if you wish to reactivate it.';
				// 	return view('user_mgt/login', $data);
				// } else {
        //
				// }
      } else {
        $data['validation'] = $this->validator;
      }
    }
    return view('user_mgt/forgot_password', $data);
  }

  protected function setSession($user)
  {
		$session_data = [
			'email'			=> $user['email'],
			'password' 		=> $user['password'],
			'role'			=> $user['role'],
			'isLoggedIn' 	=> true,
		];

		$this->session->set('logged_user', $session_data);
		return true;
	}

	protected function updateUserlog($user_id)
	{
		$userlog = new Userlog($this->request);
		$userlogModel = new UserlogModel();

		$userlog->fillUserlogData($user_id);

		$userlogModel->insert($userlog);
	}
}
