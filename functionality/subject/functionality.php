<?php
  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";


  $students =$_POST['students'];
  $classes =$_POST['classes'];
  $teachers =$_POST['teachers'];

  $userId = $_SESSION['id'];
   for ($i=0; $i <count($students) ; $i++) {
     if ($classes[$i] > 0 && $teachers[$i] > 0) {
      echo 2;
     }else {
    
       $setResults = $db->deleteSubject($userId, $students[$i]);
       echo 1;
     }

   }



 ?>
