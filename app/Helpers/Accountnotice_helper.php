<?php

function send_acc_notice($to_email = null, $subject = null, $message = null, $bcc = null, $cc = null)
{
  if(!isset($to_email) || !isset($subject) || !isset($message))
  {
    return false;
  }
  $email = \Config\Services::email();

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
    return "Sent Successfully!";
  } else {

    $data = $email->printDebugger(['headers']);
    print_r($data);
  }
}
