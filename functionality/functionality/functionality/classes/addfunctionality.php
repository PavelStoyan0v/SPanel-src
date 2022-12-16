<?php
  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";

  $class = $db->escape($_POST['classes']);
    $arr = array();
    $userId = $_SESSION['id'];
    $students = $db->getStudents($userId);

    for ($i=0; $i < count($students); $i++) {
      $info = $students[$i]["name"]." ".$students[$i]["fName"]." ".$students[$i]["class"]." ".$students[$i]["id"];

      array_push($arr, $info);

    }
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);

 ?>
