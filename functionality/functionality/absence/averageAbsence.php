<?php
  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";

  $userId = $_SESSION['id'];
  $averages = $db->getAbsence($userId);



  $arr =
  [
        [
          $averages[0][0], $averages[0][1]
        ],
        [
          $averages[1][0], $averages[1][1]
        ],
        [
          $averages[2][0], $averages[2][1]
        ],
        [
          $averages[3][0], $averages[3][1]
        ],
        [
          $averages[4][0], $averages[4][1]
        ],
        [
          $averages[5][0], $averages[5][1]
        ],
        [
          $averages[6][0], $averages[6][1]
        ],
        [
          $averages[7][0], $averages[7][1]
        ],
        [
          $averages[8][0], $averages[8][1]
        ],
        [
          $averages[9][0], $averages[9][1]
        ],
        [
          $averages[10][0], $averages[10][1]
        ],
      
  ];
   echo json_encode($arr,JSON_UNESCAPED_UNICODE );
 ?>
