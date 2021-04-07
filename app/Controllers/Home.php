<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;
use App\Models\UserlogModel;
use App\Models\EmailModel;

use \App\Entities\Userlog;

class Home extends BaseController
{
	public function index() {
		return redirect()->to(base_url('login'));
	}

	public function login()
	{
		if ($this->session->has('logged_user') && $_SESSION['logged_user']['emailVerified']) {
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
					$userToken = $this->updateUserlog($user['id']);
					$this->setSession($user, $userToken);

					// To turn this off, fetch the data from database that represents the toggle for two step verification. Simply put an if statement and when 2f verification is turned off, make sure to set $_SESSION['logged_user']['emailVerified'] to true automatically. Also unset $_SESSION loginDate and $_SESSION userToken
					$this->sendVerification();
					// To be changed for a page that notifies the email verification was sent
					return redirect()->to(base_url('verifyAccount'));
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
    $data['validate_error'] = null;
    $data['success'] = null;

    $css = ['custom/login/login.css'];
    $data['css'] = addExternal($css, 'css');

    if($this->request->getMethod() == 'post')
    {

      $rules = ['email_fpass' => 'required|valid_email|is_UP_mail'];
      $errors = [
				'email_fpass' => [
          'is_UP_mail'  => 'The email you entered is an invalid UP mail',
          'valid_email' => 'You have entered an invalid email'
        ]
      ];

      if($this->validate($rules, $errors)) {
        $email = $this->request->getVar('email_fpass', FILTER_SANITIZE_EMAIL);
        $model = new LoginModel();
				$user = $model->where('email', $email)->first();

        if(!empty($user)) {
          $userToken = $this->updateUserlog($user['id']);

					$this->setSession($user, $userToken);
          // $data['userToken'] = $userToken;
					$this->resetPasswordEmail();
          $data['success'] = true;
          // return redirect()->to(base_url('reset_password'));
        } else {
          $data['validate_error'] = 'Email does not exist.';
          return view('user_mgt/forgot_password', $data);
        }
      } else {
        $data['validation'] = $this->validator;
      }
    }
    return view('user_mgt/forgot_password', $data);
    // return redirect()->to(base_url('reset_password'));
  }

  public function reset_password($userToken = null)
  {
    // if (!$this->session->has('logged_user') && !$_SESSION['logged_user']['emailVerified']) {
		// 	return redirect()->to(base_url('login'));
		// }

    $timeElapsed = strtotime(date('Y-m-d H:i:s')) - strtotime($_SESSION['logged_user']['loginDate']); //in seconds
    $data = [];
    $data['error'] = null;
    $data['validation'] = null;

    // $userToken = $_SESSION['logged_user']['userToken'];

    if(empty($userToken)) {
      $data['error'] = 'Unauthorized access.'; //when trying to manually access the forgot_password page

    } elseif($userToken === $_SESSION['logged_user']['userToken']) {
      if($timeElapsed <= 900) {
        $_SESSION['logged_user']['passwordReset'] = true;

        if($this->request->getMethod() == 'post') {

          $rules = [
            'new_pass' => [
              'label' => 'New password',
              'rules' => 'required|min_length[8]|max_length[16]|regex_match[^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$]'
            ],
            'confirm_pass' => [
              'label' => 'Confirm Password',
              'rules' => 'required|matches[new_pass]'
            ]
          ];

          $errors = [
            'new_pass' => [
              'regex_match' => 'Weak password! <br>Password must have at least one digit, lowercase and uppercase letter and special character.'
            ]
          ];


          if($this->validate($rules, $errors)) {

            $password = password_hash($this->request->getVar('new_pass', FILTER_SANITIZE_EMAIL), PASSWORD_BCRYPT);
            $datum = ['password' => $password];

            $model = new LoginModel();
            $model->where('email', $_SESSION['logged_user']['email'])->set($datum)->update();

            $_SESSION['logged_user']['passwordReset'] = true;

            unset($_SESSION['logged_user']['userToken'], $_SESSION['logged_user']['loginDate']);
            return redirect()->to(base_url('dashboard/logout'));
          } else {

            $data['validation'] = $this->validator;
            return view('user_mgt/reset_password', $data);
          }
        }
      } else {
        $data['error'] = 'Sorry. Reset password link has expired.';
      }
    } else {
      $data['error'] = 'You are not authorized to access this page.'; //When incorrect usertoken
    }

    return view('user_mgt/reset_password', $data);
  }


	public function verification($userToken)
	{
		// In seconds
		$timeDifference = strtotime(date('Y-m-d H:i:s')) - strtotime($_SESSION['logged_user']['loginDate']);

		if($_SESSION['logged_user']['emailVerified']) {
			return redirect()->to(base_url('dashboard'));
		} elseif($userToken === $_SESSION['logged_user']['userToken']) {

			if($timeDifference <= 1800) {
				$_SESSION['logged_user']['emailVerified'] = true;
				unset($_SESSION['logged_user']['userToken'], $_SESSION['logged_user']['loginDate']);

				return redirect()->to(base_url('dashboard'));
			} else {
				// Redirect to a page that notifies the link has expired
				echo 'Sorry. Verification link has expired';
			}
		}
  }

	public function verifyAccount()
	{
		return view('verification/verification');
	}

	protected function setSession($user, $userToken)
	{
		$session_data = [
			'name'			=> $user['first_name'],
			'email'			=> $user['email'],
			'password' 		=> $user['password'],
			'role'			=> $user['role'],
      'isLoggedIn' 	=> true,
      'passwordReset' => false,
			'emailVerified' => false,
			'userToken'		=> $userToken,
			'loginDate'		=> date('Y-m-d H:i:s')
		];

		$this->session->set('logged_user', $session_data);
		return true;
	}

	protected function updateUserlog($user_id)
	{
		$userlog = new Userlog($this->request);
		$userlogModel = new UserlogModel();

		$userToken = $userlog->fillUserlogData($user_id);

		$userlogModel->insert($userlog);

		return $userToken;
	}

	protected function sendVerification()
	{
		// For sending 2f verification
    $emailModel = new EmailModel();

    $emailContent = $emailModel->where('is_deleted', '0')->where('purpose','verification')->orderBy('created_on', 'desc')->first();

    $search = ['-content-', '-student-', '-website_link-'];
    $subject = $emailContent['title'];

    $message = file_get_contents(base_url() . '/app/Views/verification.html');
		$replace = [$emailContent['message'], $_SESSION['logged_user']['name'], base_url().'/verification'.'/'.$_SESSION['logged_user']['userToken']];

		$message = str_replace($search, $replace, $message);
		$status = send_acc_notice($_SESSION['logged_user']['email'], $subject, $message);
		// For sending 2f verification
	}

  protected function resetPasswordEmail()
  {
    $emailModel = new EmailModel();

    $emailContent = $emailModel->where('is_deleted', '0')->where('purpose','forgot_pass')->orderBy('created_on', 'desc')->first();

    $search = ['-content-', '-student-', '-website_link-'];
    $subject = $emailContent['title'];

    $message = file_get_contents(base_url() . '/app/Views/verification.html');
		$replace = [$emailContent['message'], $_SESSION['logged_user']['name'], base_url().'/reset_password'.'/'.$_SESSION['logged_user']['userToken']];

		$message = str_replace($search, $replace, $message);
		$status = send_acc_notice($_SESSION['logged_user']['email'], $subject, $message);
  }
}
