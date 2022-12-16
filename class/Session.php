<?php
  session_start();

  if (!isset($_SESSION['log'])) {
    if(!isset($ignoreloggedin)){
      header("Location: ".ROOT_URL."account/login");
    }
  } else {
    $id = $_SESSION['id'];
  }

?>
