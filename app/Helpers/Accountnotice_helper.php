<?php

function send_acc_notice($to_email = null, $subject = null, $message = null, $attachment = null, $bcc = null, $cc = null)
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

  if(isset($bcc) != null) {
    $email->setBCC($bcc);
  }

  if(isset($bcc) != null ) {
    $email->setCC($cc);
  }

  if(isset($attachment) != null) {
    $filename = $attachment;
    $email->attach($filename);
  }

  if($email->send()) {
    return true;
  } else {
    $data = $email->printDebugger(['headers']);
    print_r($data);
    return false;
  }
}
