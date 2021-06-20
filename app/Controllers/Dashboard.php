<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
  public function _remap($method)
  {
    switch($method)
    {
      case 'index':
      case 'logout':
        return $this->$method();
        break;
      default:
        return $this->index();
    }
  }

  public function index()
  {
    if (!$this->session->has('logged_user')) {
      return redirect()->to(base_url('login'));
    } elseif (!$_SESSION['logged_user']['emailVerified']) {
        return redirect()->to(base_url('verifyAccount'));
    }

    $data = [
      'avatar_url' => $_SESSION['logged_user']['avatar_url'],
      'first_name' => $_SESSION['logged_user']['first_name'],
      'last_name' => $_SESSION['logged_user']['last_name'],
    ];

    if ($_SESSION['logged_user']['role'] === '2') {
      return view('user_mgt/studentDashboard', $data);
    } else
      return view('user_mgt/dashboard', $data);
  }

  public function logout()
  {
    $this->session->remove('logged_user');
    $this->session->destroy();
    return redirect()->to(base_url('login'));
  }
}
