<?php
  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";

  $subjects = $db->escape($_POST['subjects']);
  $results = $db->escape($_POST['results']);
  $students =$_POST['students'];
  $userId = $_SESSION['id'];
   for ($i=0; $i <count($students) ; $i++)
   {
      $setAbsence = $db->deleteAbsence($userId, $students[$i]);
      echo $setAbsence;
   }



 ?>
