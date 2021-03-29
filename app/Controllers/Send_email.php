<?php
namespace App\Controllers;

class Send_email extends BaseController {

  public function index() {
    $data = [];
    $rules = [
      'email_subject' => 'required',
      'email_content' => 'required'
    ];

    $data['validation'] = null;

    $email_subject = $this->request->getVar('email_subject');
    $email_content = $this->request->getVar('email_content');

    $css = ['custom/styles.css'];

    if($this->request->getMethod() == 'post')
    {
      if($this->validate($rules))
      {
        $data['css'] = addExternal($css, 'css');
      } else {
        $data = [
          'css'   => addExternal($css, 'css'),
          'validation' => $this->validator
        ];
      }
    }

    return view('email/send_email', $data);
  }
}
