<?php
  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";

  $name = $db->escape($_POST['name']);
  $fName = $db->escape($_POST['fName']);
  $email = $db->escape($_POST['email']);
  $pass = $db->escape($_POST['pass']);
  $phone = $db->escape($_POST['phone']);
  $classes = $db->escape($_POST['classes']);

  if(strlen($name) > 2 && strlen($fName) > 3 && strlen($email) > 8
  && strlen($pass) > 5 && strlen($phone) > 9)
  {
    $userId = $_SESSION['id'];
    $hashedPass = password_hash($pass, PASSWORD_BCRYPT);
    $insertStudent = $db->insertStudent('58', $name, $fName, $email, $hashedPass, $classes, $phone);

    var_dump($insertStudent);
  }else {


  }

 ?>
