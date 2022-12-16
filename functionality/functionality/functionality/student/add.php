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

          <form class="addTeachForm"  id = "name">
            <div class="row">
              <input type="text" name="" value="" class="name form-control col-sm-6" id= ""placeholder= "Име">
              <input type="text" name="" value="" class="fName form-control col-sm-6" id="" placeholder= "Фамилия">
              <input type="text" name="" value="" class="email form-control col-sm-12" id ="" placeholder= "Email">
              <input type="password" name="" value="" class="pass form-control col-sm-12" id ="" placeholder= "Парола">
              <input type="number" name="quantity" min="0" max="9" value="" class="phone form-control col-sm-12" id="enturOnlyNum" placeholder= "Телефон">
              <span id="errmsg"></span>
              <select id ="ddlViewBy">
                <option value="4b">4b</option>
                <option value="9б">9б</option>
                <option value="11б">10b</option>
                <option value="12б">11b</option>
              </select>
              <button type="button" name="button" class="btn btn-primary button">Регистрирай</button>
            </div>

          </form>

       </div>
    </div>
    <script>


      $('.btn').click(function () {
        var name = $('.name').val();
        var fName = $('.fName').val();
        var email = $('.email').val();
        var pass = $('.pass').val();
        var phone = $('.phone').val();
        var subject = $('.subject').val();
        var classes = $('select[name=selector]').val();
        var e = document.getElementById("ddlViewBy");
        var classes = e.options[e.selectedIndex].value;
        alert(classes);

        $.post("addfunctionality.php",
            {
                action: "add",
                name: name,
                fName: fName,
                email: email,
                pass: pass,
                classes: classes,
                phone: phone,
            },
            function(data, status){
                alert(data);
            });

    });

  </script>
    <?php include "../../includes/template/scripts.php"; ?>
  </div>
</body>

</html>
