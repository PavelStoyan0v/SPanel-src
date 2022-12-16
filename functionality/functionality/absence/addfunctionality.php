<?php
  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";

  $subjects = $db->escape($_POST['subjects']);
  $absence = $db->escape($_POST['absence']);
  $students =$_POST['students'];
  $userId = $_SESSION['id'];
  var_dump($subjects);
  var_dump($absence);
  var_dump($students);
  var_dump($userId);

   for ($i=0; $i <count($students) ; $i++) {
     $date  = date("Y-m-d");

      $setAbsence = $db->setAbsence($userId, $absence, $subjects, $students[$i], $date);
      echo $setAbsence;
   }



 ?>
