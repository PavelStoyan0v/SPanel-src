<?php
  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";

  $result = $db->escape($_POST['result']);
  $subject = $db->escape($_POST['subject']);
  $sdInformation = $_POST['studentsInformation'];

  $userId = $_SESSION['id'];

  for ($i=0; $i < count($sdInformation); $i++)
  {
    $setResult = $db->setResults($userId, $result, $subject, $sdInformation[$i]);
  }
  $set= $db->averageScore($userId);


 ?>
