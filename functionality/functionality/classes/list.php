<?php
  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";


  include_once ("../../class/model.php");
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../../includes/template/headincludes.php"; ?>
  <title>SB Admin - Start Bootstrap Template</title>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
    <?php
      include("../../includes/template/nav.php");
     ?>

     <div class="content-wrapper">
       <div class="container-fluid">
         <div style="overflow-x:auto;">
           <div class="card mb-3">
             <div class="card-header">
               <i class="fa fa-table"></i> Data Table Example</div>
         <table class="table table-bordered" id="example" width="100%" cellspacing="0">
           <thead>
             <tr>
               <th>Клас</th>
               <th>Класен ръководител</th>
               <th>Брой ученици</th>
             </tr>
           </thead>
           <tfoot>
             <tr>
               <th>Клас</th>
               <th>Класен ръководител</th>
               <th>Брой ученици</th>

             </tr>
           </tfoot>
           <tbody >

              <?php

                  $userId = $_SESSION['id'];
                  $userDb  = $db->userdb($userId);
                  $class = $userDb->select("classes", "*");

                  for ($i=0; $i <count($class) ; $i++) {
                    $teacher = $userDb->select("teacher", "*", ["id" => $class[$i]["teacher_id"]]);
                    $students = $userDb->select("students", "*", ["class" => $class[$i]["id"]]);
                    echo "<tr>";
                    echo "<th>".$class[$i]["class"]."</th>";
                    echo "<th>".$teacher[0]["name"]." ".$teacher[0]["fName"]."</th>";
                    echo "<th>".count($students)."</th>";
                    echo "</tr>";
                  }

               ?>
           </tbody>
         </table>


</div>
       </div>
    </div>
  </div>

    <div class="h"></div>
    <?php include "../../includes/template/scripts.php"; ?>
  </div>
</body>

</html>
