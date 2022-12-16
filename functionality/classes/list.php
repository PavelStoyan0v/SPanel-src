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
  <title>SPanel</title>
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
               <i class="fa fa-table"></i> Класове <i class="fa fa-remove remove"></i></div>
         <table class="table table-bordered" id="example" width="100%" cellspacing="0">
           <thead>
             <tr>
               <th>Клас</th>
               <th>Класен ръководител</th>
               <th>Брой ученици</th>
               <th class="hidden_td"></th>
             </tr>
           </thead>
           <tfoot>
             <tr>
               <th>Клас</th>
               <th>Класен ръководител</th>
               <th>Брой ученици</th>
               <th class="hidden_td"></th>
             </tr>
           </tfoot>
           <tbody >

              <?php

                  $userId = $_SESSION['id'];
                  $userDb  = $db->userdb($userId);
                  $class = $userDb->select("classes", "*");
                  $database = $db->connect();
                  for ($i=0; $i <count($class) ; $i++) {
                    $teacher = $database->select("users", "*", ["id" => $class[$i]["teacher_id"]]);
                    $students = $userDb->select("students", "*", ["class" => $class[$i]["id"]]);

                    echo "<tr id =  student_".$i.">";
                    echo "<th class = 1>".htmlspecialchars($class[$i]["class"])."</th>";
                    echo "<th class = 2>".htmlspecialchars($teacher[0]["name"])." ".$teacher[0]["fName"]."</th>";
                    echo "<th class = 3>".htmlspecialchars(count($students))."</th>";
                    echo "<th class = '4 hidden_td'>".$class[$i]["id"]."</th>";
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
    <script>
    var studentsCounter =[];
    var trHolder = [];
    //the container where the information for student will
    var studentsInformation = [];
    //how many paragraphs are there in .students:div
    var div = document.getElementById("students");           // Get the <div> element with id="myDIV"subject
    var nodelist = $('table th').length;
    //this is the arr who will hwlp of us
    let helper = [
      new Array(nodelist).join('0').split('').map(Number),
      new Array(nodelist).join('0').split('').map(Number)
    ]
    console.log(nodelist);
    console.log(helper);

    function greenMessage(text) {
        $.notify({
           // options
           icon: 'glyphicon glyphicon-warning-sign',
           message: text
        },{
           // settings
           allow_dismiss: true,
           timer: 3000,
           type: 'success',
           animate: {
              enter: 'animated fadeInRight',
              exit: 'animated fadeOutRight'
           },
        });
      }

      function redMessage(text) {
        $.notify({
           // options
           icon: 'glyphicon glyphicon-warning-sign',
           message: text
        },{
           // settings
           allow_dismiss: true,
           timer: 3000,
           type: 'danger',
           animate: {
              enter: 'animated fadeInRight',
              exit: 'animated fadeOutRight'
           },
        });
      }

    $('.remove').click(function ()
    {
      if (trHolder.length == 0) {
      redMessage("Моля изберете клас от таблицата");
    }else{
            for (var i = 0; i < trHolder.length; i++) {
              if (studentsCounter[i] == 0) {
                $("#"+trHolder[i]).remove();

              }

            }

            $.post("functionality",
                {
                    action: "add",
                    classesId: studentsInformation,
                    studentsCounter: studentsCounter

                },
                function(data, status)
                {
                  console.log(data);
                    if (data[0] == 1) {
                      greenMessage("Вие изтрихте успешно класът");

                    }else if (data[0] == 2) {
                        greenMessage("Вие изтрихте успешно класър, но  не можете да изтриете клас, който е пълен със ученици");
                    }else  if (data[0] == 3){
                      redMessage("Не можете да изтриете клас, който е пълен със ученици");
                    }
                });
            }

    });

    $("tr").click(function () {
      var studentInformation  = [];
      for (var i = 1; i <= 4; i++) {
        studentInformation.push( $(this).closest('tr').children('th.'+ i).text());

      }




      //get the name, fname and class of the student


      var tr = $(this).attr('id');
      var studentIdByOrder = $(this).attr('id').split('_');
      var id = studentIdByOrder;

      console.log(studentInformation);
      console.log(studentInformation.count);



      console.log(helper);
      //check if the paragraph is clicked or not before this click
      if(helper[0][id[1]] == 0){
        helper[0][id[1]] = 1;
        //add the name, fname, class to studentsInformation
        studentsInformation.push(studentInformation[3]);
        trHolder.push(tr);
        studentsCounter.push(studentInformation[2]);
        console.log(studentInformation[3]);
        $(this).css("background-color","#28a745");
        console.log();
        console.log(studentsInformation);
      }else {

        helper[0][id[1] ] = 0;
        var index = studentsInformation.indexOf(studentInformation[3]);
        var trindex = trHolder.indexOf(tr);
        var counter = studentsCounter.indexOf(studentInformation[2]);
        console.log(index);
        if (index >= 0 && trindex>=0 && counter >= 0) {
            studentsInformation.splice( index, 1 );
            trHolder.splice(trindex , 1);
            studentsCounter.splice(counter, 1);
          }
        $(this).css("background-color","white");
        console.log(index);
        console.log(studentsInformation);

      }
      console.log(studentsCounter);
    });
    </script>
    <?php include "../../includes/template/scripts.php"; ?>
  </div>
  <footer class="sticky-footer">
    <div class="container">
      <div class="text-center">
        <small>© SPanel.BG 2017-<?php echo date("Y"); ?></small>
      </div>
    </div>
  </footer>
</body>

</html>
