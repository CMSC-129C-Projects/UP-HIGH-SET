<?php

function randomize_password($studentnum = null)
{

  if(isset($studentnum)!= null)
  {
    $studnum = strval($studentnum); //get last 7 digits of the student number (unique portion)
  } else {
    return false; //no studentnumber provided
  }

  try {
      $password = random_bytes(4);
  } catch (TypeError $e) {
      // Well, it's an integer, so this IS unexpected.
      die("An unexpected error has occurred");
  } catch (Error $e) {
      // This is also unexpected because 32 is a reasonable integer.
      die("An unexpected error has occurred");
  } catch (Exception $e) {
      // If you get this message, the CSPRNG failed hard.
      die("Could not generate a random string. Is our OS secure?");
  }

   return substr($studentnum, 2, 8) . bin2hex($password) ;
}
