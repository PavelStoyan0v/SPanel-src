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
         <div class="form-holder">
           <form class="form-teacheradd" method="post">
             <div class="row">
               <h2 class="col-sm-12" style="text-align: center;">Нов клас</h2>
             </div>

             <div class="row">
               <input class="form-control col-sm-6" type="text" name="name"  placeholder="Име">
               <input class="form-control col-sm-6" type="text" name="fName" placeholder="Фамилия">
             </div>
             <div class="row">
               <div class="input-group">
                 <span class="input-group-addon" id="basic-addon-email"><i class="fa fa-envelope"></i></span>
                 <input class="form-control col-sm-12" id="studentEmail" type="text" name="count" aria-describedby="basic-addon-email" placeholder="Клас">
               </div>
             </div>
             <div class="row">
               <div class="input-group">
                 <span class="input-group-addon" id="basic-addon-phone"><i class="fa fa-phone"></i></span>
                 <input class="form-control col-sm-12" id="studentPhone" type="text" name="subjects" aria-describedby="basic-addon-phone" placeholder="Специалности">
               </div>
             </div>



         <div class="row">
           <button type="button" class="col-sm-12 btn btn-primary btn-lg btn-block btn-submit" id = "insert-btn-student">Добави клас</button>
         </div>
       </form>
     </div>
       </div>
    </div>
    <div class="h"></div>
    <script>
      function message(text) {
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

      $('.btn').click(function () {
        var name = $('input[name=name]').val();
        var fName = $('input[name=fName]').val();
        var classes = $('input[name=count]').val();
        var subject = $('input[name=subjects]').val();

        $.post("addfunctionality.php",
            {
                action: "add",
                name: name,
                fName: fName,
                subject: subject,
                classes: classes
            },
            function(data, status){
                alert(data);
                if (data == 1) {
                  message("Всички данни са вкарани успешно в база данни");
                }else if(data == 2)
                {
                  message("Моля Попъленте всички полета");
                }else if(data == 0)
                {
                  message("Моля въведете коректно име на учителя");
                }else
                {
                  message("Грешка при вкарването на данните");
                }

            });

        });


</script>




  </script>
  <?php
    include("../../includes/template/scripts.php");
   ?>
  </div>
</body>

</html>
