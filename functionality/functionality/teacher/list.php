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
               <th>Име</th>
               <th>Фамиля</th>
               <th>Email</th>
               <th>Телефон</th>
               <th>Клас</th>
             </tr>
           </thead>
           <tfoot>
             <tr>
               <th>Име</th>
               <th>Фамиля</th>
               <th>Email</th>
               <th>Телефон</th>
               <th>Клас</th>
             </tr>
           </tfoot>
           <tbody >
              <?php
              $connect = new Model();
              $conn =  $connect -> connect(DB_DATABASE);
              $id = $_SESSION["id"];

              $selectId = mysqli_query($conn,"SELECT * FROM users WHERE id = '$id'");
              $sqlArr = $selectId->fetch_array(MYSQLI_ASSOC);
              $dbNames = $sqlArr["db"];
              $db = "teacher";
              $conn2 = $connect -> connect($dbNames);
              mysqli_query($conn2,'SET NAMES utf8');
              $myArray = array();
              if($result = mysqli_query($conn2,"SELECT *  FROM `teacher`")){
                while(($row =  mysqli_fetch_assoc($result))) {
                  echo "<tr>";

                  echo "<th>".$row["name"]."</th>";
                  echo "<th>".$row["fName"]."</th>";
                  echo "<th>".$row["email"]."</th>";
                  echo "<th>".$row["phone"]."</th>";
                  echo "<th>".$row["classTeacher"]."</th>";

                  echo "</tr>";
                }
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
