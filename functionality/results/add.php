<?php
  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../../includes/template/headincludes.php" ?>
  <title>SPanel</title>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
    <?php
      include("../../includes/template/nav.php");
     ?>
     <div class="content-wrapper">
       <div class="container-fluid">

                        <!-- Example DataTables Card-->
                        <div class="card mb-3" id = "container">
                          <div class="card-header">
                            <i class="fa fa-table"></i> Оценки</div>
                          <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                    <th>Име</th>
                                    <th>Фамиля</th>
                                    <th>Клас</th>
                                    <th class="hidden_td"></th>
                                  </tr>
                                </thead>
                                <tfoot>
                                  <tr>
                                    <th>Име</th>
                                    <th>Фамиля</th>
                                    <th>Клас</th>
                                    <th class="hidden_td"></th>
                                  </tr>
                                </tfoot>
                                <tbody >
                                  <?php
                                     $userId = $_SESSION['id'];
                                     $students =  $db->getStudents($userId);
                                     $userDb = $db->userdb($userId);
                                     for ($i=0; $i < count($students) ; $i++) {
                                       $class = $userDb -> select("classes", "*", [
                                         'id' => $students[$i]["class"]
                                       ]);
                                       echo "<tr id =  student_".$i.">";
                                       echo "<th class = 1>".htmlspecialchars($students[$i]["name"])."</th>";
                                       echo "<th class = 2>".htmlspecialchars($students[$i]["fName"])."</th>";
                                       echo "<th class = 3>".htmlspecialchars($class[0]['class'])."</th>";
                                       echo "<th class = '4 hidden_td'>" .$students[$i]["id"]."</th>";
                                       echo "</tr>";
                                     }
                                   ?>
                                </tbody>
                              </table>
                          </div>

                        </div>
                        </div>
                      <div class = "select-holder">
                        <select class="form-control col-sm-3 res" id="sel2" placeholder="Клас на ученика" data-live-search="true" style="">
                           <option value="1" disabled selected>Моля изберете оценка</option>
                          <option value="">2</option>
                          <option value="">3</option>
                          <option value="">4</option>
                          <option value="">5</option>
                          <option value="">6</option>
                        </select>
                        <select class="form-control col-sm-3 sub" id="sel2" placeholder="Клас на ученика" data-live-search="true">
                            <option value="1" disabled selected>Моля изберете предмет</option>
                          <?php
                          $userId = $_SESSION['id'];
                          $database = $db->userdb($userId);
                          $getClasses = $database->select("subjects", "*");
                          for ($i=0; $i <count($getClasses) ; $i++) {
                            echo "<option>".$getClasses[$i]["subject"]."</option>";
                          }
                          ?>
                        </select>
                      </div>
                      </div>
                      <button type="button" name="button" class="btn btn-primary button btn-submit">Напиши</button>
                    </div>


             <div class="h"></div>
             <script>
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

                 $('.btn-submit').click(function ()
                 {

                     var subjects = $( ".sub option:selected" ).text();
                     var results = $( ".res option:selected" ).text();
                     var subjects2 = $( ".res option:selected" ).val();
                     var results2 = $( ".sub option:selected" ).val();


                     if (subjects2 == 1 && results2 == 1 || subjects2 == 1 || results2 == 1 )
                     {
                       redMessage("Моля изберете оценка и предмет");
                     }
                     else
                     {
                       if (studentsInformation.count == 0)
                       {
                         redMessage("Моля изберете ученик");
                       }
                       else
                       {
                         for (var i = 0; i < trHolder.length; i++) {
                           $("#"+ trHolder[i]).css("background-color","white");
                         }
                         trHolder= [];



                         $.post("addfunctionality.php",
                             {
                                 action: "add",
                                 students: studentsInformation,
                                 subjects: subjects,
                                 results: results,
                             },
                             function(data, status)
                             {
                                
                                  greenMessage("Оценките са написани успешно")

                             });
                              studentsInformation = [];
                              helper = [
                                new Array(nodelist).join('0').split('').map(Number),
                                new Array(nodelist).join('0').split('').map(Number)
                              ]
                     }
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






                   //check if the paragraph is clicked or not before this click
                   if(helper[0][id[1]] == 0){
                     helper[0][id[1]] = 1;
                     //add the name, fname, class to studentsInformation
                     studentsInformation.push(studentInformation[3]);
                     trHolder.push(tr);

                     $(this).css("background-color","#28a745");

                   }else {

                     helper[0][id[1] ] = 0;
                     var index = studentsInformation.indexOf(studentInformation[3]);
                     var trindex = trHolder.indexOf(tr);

                     if (index >= 0 && trindex>=0) {
                         studentsInformation.splice( index, 1 );
                         trHolder.splice(trindex , 1);
                       }
                     $(this).css("background-color","white");

                   }

                 });
             </script>
           <?php
             include("../../includes/template/scripts.php");
            ?>
  <footer class="sticky-footer">
    <div class="container">
      <div class="text-center">
        <small>© SPanel.BG 2017-<?php echo date("Y"); ?></small>
      </div>
    </div>
  </footer>
</body>

</html>
