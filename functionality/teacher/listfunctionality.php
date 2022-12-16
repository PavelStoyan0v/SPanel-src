<?php
  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";

  $subjects = $db->escape($_POST['subjects']);
  $results = $db->escape($_POST['results']);
  $students =$_POST['students'];
  $userId = $_SESSION['id'];
  $emails = $_POST['emails'];
   for ($i=0; $i <count($students) ; $i++) {

     
      $setResults = $db->deleteTeachers($userId, $students[$i], $emails[$i]);
      echo $setResult;

   }



 ?>
