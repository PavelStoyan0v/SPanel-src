<?php
  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";

  $name = $db->escape($_POST['name']);
  $fName = $db->escape($_POST['fName']);
  $subject = $db->escape($_POST['subject']);
  $class = $db->escape($_POST['classes']);

  if(strlen($name) > 1 && strlen($fName) > 3 && strlen($subject) > 1 && strlen($class) > 1)
  {
    $userId = $_SESSION['id'];
    $insertClass = $db->insertClass($userId, $name, $fName, $subject, $class);
    echo $insertClass;
  }else if (strlen($name) == 0 || strlen($fName) == 0 || strlen($subject) == 0 || strlen($class) == 0) {
     
    echo 2;
  }
 ?>
