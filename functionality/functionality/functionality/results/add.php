<?php
  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../../includes/template/headincludes.php" ?>
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
              <select name="results" class="form-control results">
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
              </select>


              <select name="subject" class="form-control subject">
                <option value="music">Музика</option>
                <option value="dev">Информатика</option>
                <option value="bulgarian">Български</option>
                <option value="math">Математика</option>
                <option value="phisics">Физика</option>
              </select>

              <div class="students" id="students">
              <?php
                  $userId = $_SESSION['id'];
                  $getStudent = $db->getStudents($userId);

                  for ($i=0; $i <count($getStudent) ; $i++) {
                    echo "<p id = student_$i><a id = studentId>".$getStudent[$i]["id"].' '."</a>".$getStudent[$i]["name"].' '.$getStudent[$i]["fName"].' '.$getStudent[$i]["class"]."</p>";
                  }
               ?>
              </div>
              <button type="button" name="button" class="btn btn-primary button btn-submit">Напиши</button>
            </div>
          </form>
       </div>
    </div>
    <script>
    //the container where the information for student will
    var studentsInformation = [];
    //how many paragraphs are there in .students:div
    var div = document.getElementById("students");           // Get the <div> element with id="myDIV"subject
    var nodelist = div.getElementsByTagName("P").length;
    //this is the arr who will help of us
    let helper = [
      new Array(nodelist+1).join('0').split('').map(Number),
      new Array(nodelist+1).join('0').split('').map(Number)
    ]

      $('.btn-submit').click(function () {
        var result = $( ".results option:selected" ).text();
        var subject = $( ".subject option:selected" ).text();

        $.post("addfunctionality.php",
            {
                action: "add",
                result:  result,
                studentsInformation: studentsInformation,
                subject: subject
            },
            function(data, status){
              alert(data);
            });

        });

        $("p").click(function () {
          //get the name, fname and class of the student
          var studentIdByOrder = $(this).attr('id').split('_');
          var id = studentIdByOrder;
          var studentInformation = $(this).text().split(' ');


          console.log(helper);
          //check if the paragraph is clicked or not before this click
          if(helper[0][id[1]] == 0){
            helper[0][id[1]] = 1;
            //add the name, fname, class to studentsInformation
            studentsInformation.push(studentInformation[0]);

            $(this).css("background-color","green");
            console.log(helper);
            console.log(studentsInformation);
          }else {

            helper[0][id[1] ] = 0;
            var index = studentsInformation.indexOf(studentInformation[0]);
            if (index >= 0) {
              studentsInformation.splice( index, 1 );
              }
            $(this).css("background-color","white");

            console.log(studentsInformation);
          }
        });

  </script>
    <?php include "../../includes/template/scripts.php"; ?>
  </div>
</body>

</html>
