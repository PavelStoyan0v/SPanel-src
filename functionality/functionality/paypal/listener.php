<?php
  namespace Listener;
  require('../../class/PaypalIPN.php');
  use PaypalIPN;
  $ipn = new PaypalIPN();
  // Use the sandbox endpoint during testing.
  $ipn->useSandbox();
  $verified = $ipn->verifyIPN();
  if ($verified) {
    $file = fopen("log.txt", "w");
    fwrite($file, var_dump($_POST));
    fclose($file);
  }
  // Reply with an empty 200 response to indicate to paypal the IPN was received correctly.
  header("HTTP/1.1 200 OK");
