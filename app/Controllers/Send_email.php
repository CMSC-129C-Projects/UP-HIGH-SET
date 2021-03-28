<?php
namespace App\Controllers;

class Send_email extends BaseController {

  public function index() {

    // $email_subject = $this->input->post['email_subject'];
    // $email_content = $this->input->post['email_content'];

    $css = ['custom/styles.css'];

    $data = [
      'css'   => addExternal($css, 'css')
    ];

    return view('email/send_email', $data);
  }
}
