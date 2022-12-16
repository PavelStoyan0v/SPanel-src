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
         <form class="writeResults"  id = "name">
           <div class="row">
             <div class="students" id="students">
               <input type="text" name="search" value="" class="search_box">
               <table class="studentsInfo" id="table">
                 <tr>
                   <th>Name</th>
                   <th>Famile Name</th>
                   <th>class</th>
                 </tr>

               </table>
             </div>
             <button type="button" name="button" class="btn btn-primary button btn-submit">Напиши</button>
           </div>
         </form>
       </div>
    </div>
    <div class="h"></div>
    <script>
        //the container where the information for student will
        var studentsInformation = [];
        //how many paragraphs are there in .students:div
        var div = document.getElementById("students");           // Get the <div> element with id="myDIV"subject
        var nodelist = $('#table tr').length;
        //this is the arr who will hwlp of us
        let helper = [
          new Array(nodelist).join('0').split('').map(Number),
          new Array(nodelist).join('0').split('').map(Number)
        ]
        console.log(nodelist);
        console.log(helper);

        $('.btn').click(function ()
        {

          $.post("addfunctionality.php",
              {
                  action: "add",

              },
              function(data, status)
              {
                console.log(data);
                var getStudents = JSON.parse(data);
                for (var i = 0; i < getStudents.length; i++) {

                  var students = getStudents[i].split(' ');
                  $("#table").append("<tr id = student_$i><td class = 1>" + students[0] + "</td><td class = 2>" + students[1] + "</td>"+
                    "<td class = 3>" + students[2] + "</td><td class = '4 hidden_td'>" + students[3] + "</td></tr>")
                }
                 nodelist = $('#table tr').length;
                  helper = [
                   new Array(nodelist).join('0').split('').map(Number),
                   new Array(nodelist).join('0').split('').map(Number)
                 ]
                console.log(nodelist);
                console.log(helper);
              });
        });

        $("tr").click(function () {
          var a  = [];
          for (var i = 1; i <= 4; i++) {
            a +=" " + $(this).closest('tr').children('td.'+ i).text();

          }
          console.log(a);

          //get the name, fname and class of the student
          var studentIdByOrder = $(this).attr('id').split('_');
          var id = studentIdByOrder;
          var studentInformation = a.split(' ');
          console.log(studentInformation);


          console.log(helper);
          //check if the paragraph is clicked or not before this click
          if(helper[0][id[1]] == 0){
            helper[0][id[1]] = 1;
            //add the name, fname, class to studentsInformation
            studentsInformation.push(studentInformation[4]);

            $(this).css("background-color","green");
            console.log();
            console.log(studentsInformation);
          }else {

            helper[0][id[1] ] = 0;
            var index = studentsInformation.indexOf(studentInformation[4]);
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
</body>

</html>
