<?php
  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";

  $subjects = $db->escape($_POST['subjects']);
  $results = $db->escape($_POST['results']);
  $students =$_POST['students'];
  $userId = $_SESSION['id'];
  var_dump($subjects);
  var_dump($results);
  var_dump($students);
  var_dump($userId);
   for ($i=0; $i <count($students) ; $i++) {
     $date  = date("Y-m-d");

      $setResults = $db->setResults($userId, $results, $subjects, $students[$i], $date);
      echo $setResults;
   }



 ?>
