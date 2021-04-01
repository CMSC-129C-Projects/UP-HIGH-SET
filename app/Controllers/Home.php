<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;
use App\Models\UserlogModel;

use \App\Entities\Userlog;

class Home extends BaseController
{
	public $session;

	public function __construct()
	{
		$this->session = session();
	}

	public function index() {
		return redirect()->to(base_url('login'));
	}

	public function login()
	{
		$data['validation'] = null;
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

				$this->updateUserlog($user['id']);
				$this->setSession($user);
				return redirect()->to(base_url('dashboard'));

			} else {
				$data['validation'] = $this->validator;
			}
		}

		return view('user_mgt/login', $data);
	}

  	protected function setSession($user)
  	{
		$session_data = [
			'email' => $user['email'],
			'password' => $user['password'],
			'isLoggedIn' => true,
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
