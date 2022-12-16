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
                   <i class="fa fa-table"></i> Ученицци</div>
                 <div class="card-body">
                   <div class="table-responsive">
                     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                       <thead>
                         <tr>
                           <th>Име</th>
                           <th>Фамиля</th>
                           <th>Клас</th>
                         </tr>
                       </thead>
                       <tfoot>
                         <tr>
                           <th>Име</th>
                           <th>Фамиля</th>
                           <th>Клас</th>
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
                              echo "<th class = 1>".$students[$i]["name"]."</th>";
                              echo "<th class = 2>".$students[$i]["fName"]."</th>";
                              echo "<th class = 3>".$class[0]['class']."</th>";
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
               <select class="form-control col-sm-3 abs" id="sel1" placeholder="Клас на ученика" data-live-search="true" style="">
                  <option value="1" disabled selected>Моля изберете</option>
                 <option value="">0.5</option>
                 <option value="">1</option>
               </select>
               <select class="form-control col-sm-3 sub" id="sel1" placeholder="Клас на ученика" data-live-search="true">
                   <option value="1" disabled selected>Моля изберете предмет</option>
                 <?php
                 $userId = $_SESSION['id'];
                 $database = $db->userdb($userId);
                 $userEmail = $db->connect();

                 $getSubject =  $database->select("subjects", "*");

                      for ($i=0; $i <count($getSubject) ; $i++) {
                        # code...
                        echo "<option>".  $getSubject[$i]["subject"]."</option>";
                      }

                   ?>
               </select>
             </div>
             </div>
             <button type="button" name="button" class="btn btn-primary button btn-submit">Напиши</button>
           </div>


    <div class="h"></div>
    <script>
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

        $('.btn').click(function ()
        {
            var subjects = $( ".sub option:selected" ).text();
            var absence = $( ".abs option:selected" ).text();
            var subjects2 = $( ".res option:selected" ).val();
            var absence2 = $( ".abs option:selected" ).val();

            if (subjects2 == 1 && absence2 == 1 || subjects2 == 1 || absence2 == 1 )
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
                $.post("addfunctionality.php",
                    {
                        action: "add",
                        students: studentsInformation,
                        subjects: subjects,
                        absence: absence,
                    },
                    function(data, status)
                    {
                      console.log(data);
                        if (data == 1) {
                          greenMessage("Оценките са написани успешно")
                        }else if (data == 0) {
                          redMessage("Грешка при вкарването на данните");
                        }
                    });
            }
          }
        });

        $("tr").click(function () {
          var studentInformation  = [];
          for (var i = 1; i <= 4; i++) {
            studentInformation.push( $(this).closest('tr').children('th.'+ i).text());

          }




          //get the name, fname and class of the student
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
            console.log(studentInformation[3]);
            $(this).css("background-color","#28a745");
            console.log();
            console.log(studentsInformation);
          }else {

            helper[0][id[1] ] = 0;
            var index = studentsInformation.indexOf(studentInformation[3]);
            console.log(index);
            if (index >= 0) {
                studentsInformation.splice( index, 1 );
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
