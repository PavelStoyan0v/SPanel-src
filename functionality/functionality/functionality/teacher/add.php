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

          <form class="addTeachForm"  id = "name">
            <div class="row">
              <input type="text" name="" value="" class="name form-control col-sm-6" id= "addName"placeholder= "Име">
              <input type="text" name="" value="" class="fName form-control col-sm-6" id="addNme" placeholder= "Фамилия">
              <input type="text" name="" value="" class="email form-control col-sm-12"id ="addTeachn" placeholder= "Email">
              <input type="password" name="" value="" class="pass form-control col-sm-12"id ="addTachIn" placeholder= "Парола">
              <input type="text" name="" value="" class="phone form-control col-sm-12" id="addTeahIn" placeholder= "Телефон">
              <input type="text" name="" value="" class="subject form-control col-sm-12" id="addeachIn" placeholder= "Предмет">
               <button type="button" name="button" class="btn btn-primary button btn-submit">Регистрирай</button>
            </div>

          </form>

       </div>
    </div>
    <script>
      $('.btn-submit').click(function () {
    var name = $('.name').val();
    var fName = $('.fName').val();
    var email = $('.email').val();
    var pass = $('.pass').val();
    var phone = $('.phone').val();
    var subject = $('.subject').val();
    $.post("addfunctionality.php",
        {
            action: "add",
            name: name,
            fName: fName,
            email: email,
            pass: pass,
            phone: phone,
            subject:subject
        },
        function(data, status){
            alert(data);
            if (data == "rigth") {

            }else
            {

            }

        });

    });

  </script>
    <?php include "../../includes/template/scripts.php"; ?>
  </div>
</body>

</html>
