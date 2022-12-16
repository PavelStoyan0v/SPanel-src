<?php
  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";

  //if(isset($_POST['class']) && isset($_POST['subject'])) {
    $classid = $_POST['class'];
    $students = $db->getStudentsFromClass($classid);
    echo json_encode($students);
  //}
?>
