<?php
namespace App\Controllers;

use App\Models\EmailModel;

class Send_email extends BaseController {

  public function index() {
    $data = [];
    $rules = [
      'email_subject' => 'required',
      'email_content' => 'required',
      'purpose' => 'required'
    ];

    $data['validation'] = null;

    $email_subject = $this->request->getVar('email_subject');
    $email_content = $this->request->getVar('email_content');
    $email_purpose = $this->request->getVar('purpose');

    $css = ['custom/styles.css'];

    if($this->request->getMethod() == 'post')
    {
      if($this->validate($rules))
      {
        $data['css'] = addExternal($css, 'css');
        $emailModel = new EmailModel();

        $q_data = [
          'title' => $email_subject,
          'message' => $email_content,
          'purpose' => $email_purpose
        ];

        $emailModel->insert($q_data);
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
