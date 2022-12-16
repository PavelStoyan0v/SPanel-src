<?php

  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";

  $name = $db->escape($_POST['name']);
  $fName = $db->escape($_POST['fName']);
  $email = $db->escape($_POST['email']);
  $pass = $db->escape($_POST['pass']);
  $phone = $db->escape($_POST['phone']);
  $subject = $db->escape($_POST['subject']);

  //data validation
  if(strlen($name) > 2 && strlen($fName) > 3 && strlen($email) > 8
  && strlen($pass) > 5 && strlen($phone) > 9 && strlen($subject) > 2)
  {
    $userId = $_SESSION['id'];
    $hashedPass = password_hash($pass, PASSWORD_BCRYPT);
    $insertTeacher = $db->insertTeacher($userId, $name, $fName, $email, $hashedPass, $phone, $subject);
    var_dump($insertTeacher);
    if ($insertTeacher) {
      echo "The data is inserted successfull";
    }else {
      echo "Data is not inserted";
    }
  }
 ?>
