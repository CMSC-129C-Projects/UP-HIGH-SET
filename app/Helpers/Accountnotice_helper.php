<?php

// function send_acc_notice($to_email = null, $subject = null, $message = null, $bcc = null, $cc = null)
function send_acc_notice()
{
  $email = \Config\Services::email();

  $to_email = 'rsrazonable1@up.edu.ph'; //email that can receive
  $subject = 'Account Activation';

  $message = 'Sample Message';

  $email->setTo($to_email);
  $email->setFrom('rsrazonable1218@gmail.com', 'UP High SET'); //email_from and name //you can change email here ra sad

  $email->setSubject($subject);
  $email->setMessage($message);

  if(isset($bcc)) {
    $email->setBCC($bcc);
  }

  if(isset($bcc)) {
    $email->setCC($cc);
  }

  if($email->send()) {
    echo "Sent Successfully!";
  } else {

    $data = $email->printDebugger(['headers']);
    print_r($data);
  }
}
