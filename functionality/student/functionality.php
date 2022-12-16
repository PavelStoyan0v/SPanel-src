<?php
  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";

  $students =$_POST['students'];
  $userId = $_SESSION['id'];
   for ($i=0; $i <count($students) ; $i++) {

      $deleteStudents = $db->deleteStudents($userId, $students[$i]);
      echo $deleteStudents;
   }



 ?>
