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
  $img = $db->escape($_POST['img']);

  if(strlen($name) > 2 && strlen($fName) > 3 && strlen($email) > 8
  && strlen($pass) > 5 && strlen($phone) == 10)
  {
    if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
    echo 6;
}else{
    $userId = $_SESSION['id'];
    $hashedPass = password_hash($pass, PASSWORD_BCRYPT);
  
    $insertStudent = $db->insertStudent($userId, $name, $fName, $email, $hashedPass, $classes, $phone, $img);

    echo $insertStudent;
}
  }
  else if (strlen($name) == 0 || strlen($fName) == 0 || strlen($email) == 0
  || strlen($pass) == 0 || strlen($phone) == 0)
   {
    //if the user isnt entered some of the inputs
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
