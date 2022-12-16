<?php

  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";
  ini_set('upload_max_filesize', '20M');
  $name = $db->escape($_POST['name']);
  $fName = $db->escape($_POST['fName']);
  $email = $db->escape($_POST['email']);
  $pass = $db->escape($_POST['pass']);
  $phone = $db->escape($_POST['phone']);
  $subject = $db->escape($_POST['subject']);
  $secondSubject = $db->escape($_POST['secondSubject']);
  $img = $db->escape($_POST['img']);
  //data validation
  if(strlen($name) > 2 && strlen($fName) > 3 && strlen($email) > 8
  && strlen($pass) > 5 && strlen($phone) == 10 && strlen($subject) > 2)
  {
    if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
    echo 5;
}else{
    // Return Success - Valid Email
    $userId = $_SESSION['id'];
    $hashedPass = password_hash($pass, PASSWORD_BCRYPT);
    $insertTeacher = $db->insertTeacher($userId, $name, $fName, $email, $hashedPass, $phone, $subject, $secondSubject, $img);
    echo $insertTeacher;
  }
}
  else
  {
    echo 2;
  }

  if (strlen($phone) != 10) {
   //the length of the number isnt ten
   echo 7;
 }
 if (strlen($pass) < 6 ) {
  //the length of the number isnt ten
  echo 8;
}

 ?>
