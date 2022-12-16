<?php
  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";

  $userId = $_SESSION['id'];
  $averages = $average->getStudents($userId);


  $count = count($averages);

  $arr =[
      [
        $averages[$count - 1][0], $averages[$count - 1][1]
      ],
      [
        $averages[$count - 2][0], $averages[$count - 2][1]
      ],
      [
        $averages[$count - 3][0], $averages[$count - 3][1]
      ],
  ];
   echo json_encode($arr,JSON_UNESCAPED_UNICODE );
 ?>
