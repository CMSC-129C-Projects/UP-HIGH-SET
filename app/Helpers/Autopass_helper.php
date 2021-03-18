<?php

function randomize_password()
{
    try {
      $password = random_bytes(8);
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

  return bin2hex($password);
}
