<?php
  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";
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



               <!-- Example DataTables Card-->
               <div class="card mb-3" id = "container">
                 <div class="card-header">
                   <i class="fa fa-table"></i> Ученици <i class="fa fa-remove remove"></i></div>
                 <div class="card-body">
                   <div class="table-responsive">
                     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                       <thead>
                         <tr>
                           <th>Предмет</th>
                           <th>Име</th>
                           <th>Фамиля</th>
                           <th>Клас</th>
                           <th>Отсъстеив</th>
                           <th class= "hidden_td">dddd</th>
                         </tr>
                       </thead>
                       <tfoot>
                         <tr>
                           <th>Предмет</th>
                           <th>Име</th>
                           <th>Фамиля</th>
                           <th>Клас</th>
                           <th>Отсъстеив</th>
                           <th class="hidden_td">som</th>
                         </tr>
                       </tfoot>
                       <tbody >
                         <?php
                            $userId = $_SESSION['id'];

                            $userDb = $db->userdb($userId);

                            $getAbsence = $userDb->select("absence", "*" );
                            for ($i=0; $i < count($getAbsence) ; $i++) {
                              $student = $userDb -> select("students", "*", [
                                'id' => $getAbsence[$i]["student_id"]
                              ]);

                              $getSubject  = $userDb->select("subjects", "*", [
                                'id' => $getAbsence[$i]["subject"]
                              ]);
                              $getClass = $userDb->select("classes", "*" ,[
                                'id' => $student[0]["class"]
                              ]);
                              echo "<tr id =  student_".$i.">";
                              echo "<th class = 1>". htmlspecialchars($getSubject[0]["subject"])."</th>";
                              echo "<th class = 2>". htmlspecialchars($student[0]["name"])."</th>";
                              echo "<th class = 3>". htmlspecialchars($student[0]["fName"])."</th>";
                              echo "<th class = 4>". htmlspecialchars($getClass[0]["class"])."</th>";
                              echo "<th class = 5>". htmlspecialchars($getAbsence[$i]["absence"])."</th>";
                              echo "<th class = '6 hidden_td'>" . htmlspecialchars($getAbsence[$i]["id"])."</th>";
                              echo "</tr>";
                            }
                          ?>
                       </tbody>
                     </table>
                 </div>

               </div>
               </div>

             </div>

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

        $('.remove').click(function ()
        {
          if (trHolder.legth == 0) {
          redMessage("Моля изберете ученик от таблицата");
        }else{
                for (var i = 0; i < trHolder.length; i++) {
                  $("#"+trHolder[i]).remove();
                  console.log("hi");
                }

                $.post("functionality.php",
                    {
                        action: "add",
                        students: studentsInformation,

                    },
                    function(data, status)
                    {
                      console.log(data);
                        greenMessage("Вие изтрихте успешно оценките");
                    });
                }

        });

        $("tr").click(function () {
          var studentInformation  = [];
          for (var i = 1; i <= 6; i++) {
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
            studentsInformation.push(studentInformation[5]);
            trHolder.push(tr);
            console.log(studentInformation[5]);
            $(this).css("background-color","#28a745");
            console.log();
            console.log(studentsInformation);
          }else {

            helper[0][id[1] ] = 0;
            var index = studentsInformation.indexOf(studentInformation[5]);
            var trindex = trHolder.indexOf(tr);
            console.log(index);
            if (index >= 0 && trindex>=0) {
                studentsInformation.splice( index, 1 );
                trHolder.splice(trindex , 1);
              }
            $(this).css("background-color","white");
            console.log(index);
            console.log(studentsInformation);
          }

        });
    </script>
  <?php
    include("../../includes/template/scripts.php");
   ?>
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
