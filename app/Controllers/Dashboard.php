<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
  public function index() {
    if (!session()->has('logged_user')) {
      return redirect()->to(base_url('login'));
    }
      return view('user_mgt/dashboard');
  }

  public function logout()
  {
    session()->remove('logged_user');
    session()->destroy();
    return redirect()->to(base_url('login'));
  }
}
