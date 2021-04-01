<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
  public function index() {
    if (!session()->has('logged_user')) {
      return redirect()->to(base_url('home/login'));
    }
    return view('user_mgt/dashboard');
  }
}
