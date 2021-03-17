<?php

function send_acc_notice($to_email = null, $subject = null, $message = null, $bcc = null, $cc = null)
{
  $email = \Config\Services::email();

  if(!isset($to_email) || !isset($subject) || isset($message))
  {
    return false;
  }

  $email->setTo($to_email); //set email recipient

  //first argument is for the email for which the email notif came from
  //second argument is the name that will appear for the said Email
  $email->setFrom('', 'UP High SET'); //setup sender

  //setup subject and message
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
    // <script>
    //   alert('Email Notification was successfully sent.');
    // </script>
  } else {

    $data = $email->printDebugger(['headers']);
    print_r($data);
  }
}
