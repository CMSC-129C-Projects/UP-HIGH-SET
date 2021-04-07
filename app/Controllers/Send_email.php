<?php
namespace App\Controllers;

use App\Models\EmailModel;

class Send_email extends BaseController {

  public function index() {
    // redirect to login if no session found
    // redirect to verifyAccount page if session not yet verified
    if (!$this->session->has('logged_user')) {
      return redirect()->to(base_url('login'));
    } elseif (!$_SESSION['logged_user']['emailVerified']) {
      return redirect()->to(base_url('verifyAccount'));
    }

    $data = [];
    $rules = [
      'email_subject' => 'required',
      'email_content' => 'required',
      'purpose' => 'required'
    ];

    $data['validation'] = null;
    $data['status'] = null;

    $email_subject = $this->request->getVar('email_subject');
    $email_content = $this->request->getVar('email_content');
    $email_purpose = $this->request->getVar('purpose');

    $css = ['custom/modalAddition.css', 'custom/alert.css'];
    $js = ['custom/alert.js'];
    $data['css'] = addExternal($css, 'css');
    $data['js'] = addExternal($js, 'javascript');

    if($this->request->getMethod() == 'post')
    {
      if($this->validate($rules))
      {
        $data['status'] = 'success';
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
