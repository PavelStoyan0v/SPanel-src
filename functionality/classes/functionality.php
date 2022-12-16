<?php
  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";

  $classes = $_POST['classesId'];
  $studentsCounter = $_POST['studentsCounter'];
  $userId = $_SESSION['id'];
  $counter = 0;
  $delete = 0;
   for ($i=0; $i <count($classes) ; $i++)
    {

      if ($studentsCounter[$i] != 0)
      {
        $counter++;
      }
      else
      {
        $deleteClasses = $db->deleteClasses($userId, $classes[$i]);
        $delete = 1;
      }
      if ($counter != 0 && $deleteClasses == 1) {
        echo 2;
      }else if ($counter != 0 && $deleteClasses != 1) {
        echo 3;
      }else if ($counter == 0 && $deleteClasses == 1) {
        echo 1;
      }
   }




 ?>
