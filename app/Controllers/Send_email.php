<?php
namespace App\Controllers;

use App\Models\EmailModel;

class Send_email extends BaseController {

  public function _remap($method)
  {
    $this->hasSession();
    $this->role_checking(['2']);

    switch($method)
    {
        case 'index':
          return $this->$method();
          break;
        default:
          return redirect()->to(base_url('dashboard'));
    }
  }

  public function index() {
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
        $emailModel = new EmailModel();

        $q_data = [
          'title' => $email_subject,
          'message' => $email_content,
          'purpose' => $email_purpose
        ];

        // $data['status'] = $emailModel->insert($q_data) ? true: false;
        $data['status'] = $this->send_notification($q_data);

      } else {
        $data = [
          'css'   => addExternal($css, 'css'),
          'validation' => $this->validator,
          'status' => null
        ];
      }
    }

    $data['status'] = $data['status'] ? 'true' : (isset($data['status']) ? 'false' : null);

    return view('email/send_email', $data);
  }

  protected function send_notification($data = null)
  {
    if(isset($data))
    {
      $emailModel = new EmailModel();

      //alert user that his/her account's password changed if you did not do it
      $search = ['-content-', '-student-', '-website_link-'];
      $subject = $data['title'];

      $message = file_get_contents('app/Views/verification.html');
  		$replace = [$data['message'], $_SESSION['logged_user']['first_name'], base_url()]; //redirect to login page

  		$message = str_replace($search, $replace, $message);
  		$status = send_acc_notice($_SESSION['logged_user']['email'], $subject, $message);

      return $status;
    }
  }
}
