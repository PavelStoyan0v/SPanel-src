<?php
  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";

  $subject = $db->escape($_POST['subject']);


  if(strlen($subject) > 2 )
  {
    $userId = $_SESSION['id'];
    $hashedPass = password_hash($pass, PASSWORD_BCRYPT);
    $insertStudent = $db->setSubject($userId, $subject);

    echo $insertStudent;
  }else if (strlen($name) == 0) {
    //if the user isnt entered any subject
    echo 2;
  }

 ?>
