<?php
namespace App\Controllers;

class Send_email extends BaseController {

  public function index() {
    
    return view('email/send_email');
  }
}
