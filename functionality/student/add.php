<?php
  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../../includes/template/headincludes.php"; ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css">
  <title>SPanel</title>
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
               <div class="avatar">
                 <img class="teacher-icon" src="<?php echo ROOT_URL; ?>includes/img/icons/teacher.svg" alt="TeacherIcon">
                 <span class="upload-image">Качи снимка</span>
                 <div style="width: 0px;height: 0px;overflow: hidden;">
                   <input name="upload" type="file" id="fileinput" accept='image/*'/>
                 </div>
               </div>
             </div>

             <div class="row">
               <h2 class="col-sm-12" style="text-align: center;">Нов ученик</h2>
             </div>

             <div class="row">
               <input class="form-control col-sm-6" type="text" name="name"  placeholder="Име">
               <input class="form-control col-sm-6" type="text" name="fName" placeholder="Фамилия">
             </div>
             <div class="row">
               <div class="input-group">
                 <span class="input-group-addon" id="basic-addon-email"><i class="fa fa-envelope"></i></span>
                 <input class="form-control col-sm-12" id="studentEmail" type="text" name="email" aria-describedby="basic-addon-email" placeholder="Email">
               </div>
             </div>
             <div class="row">
               <div class="input-group">
                 <span class="input-group-addon" id="basic-addon-phone"><i class="fa fa-phone"></i></span>
                 <input class="form-control col-sm-12" id="studentPhone" type="text" name="phone" aria-describedby="basic-addon-phone" placeholder="Телефон">
               </div>
             </div>
             <div class="row">
               <div class="input-group">
                 <span class="input-group-addon" id="basic-addon-password"><i class="fa fa-lock"></i></span>
                 <input class="form-control col-sm-12" type="password" name="password" aria-describedby="basic-addon-password" placeholder="Парола">
               </div>
             </div>
             <div class="row">
               <div class="input-group">
                 <div class="form-group">
                   <label for="sel">Избери клас:</label>
                   <select class="form-control" id="sel1" placeholder="Клас на ученика" data-live-search="true">
                     <?php
                         $userId = $_SESSION['id'];
                         $database = $db->userdb($userId);
                         $getClasses = $database->select("classes", "*");
                         for ($i=0; $i <count($getClasses) ; $i++) {
                           echo "<option>".$getClasses[$i]["class"]."</option>";
                         }
                      ?>
                   </select>
                 </div>
               </div>
            </div>
              <div class="row">
               <button type="button" class="col-sm-12 btn btn-primary btn-lg btn-block btn-submit" id = "insert-btn-student">Добави ученик</button>
             </div>
           </form>
         </div>
       </div>
    </div>
    <script>
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
    var imagebase64 = null;
    $('.btn-submit').click(function () {
      var name = $('input[name=name]').val();
      var fName = $('input[name=fName]').val();
      var email = $('input[name=email]').val();
      var pass = $('input[name=password]').val();
      var phone = $('input[name=phone]').val();
      var classes = $( "#sel1 option:selected" ).text();


      $.post("addfunctionality.php",
          {
              action: "add",
              name: name,
              fName: fName,
              email: email,
              pass: pass,
              phone: phone,
              classes: classes,
              img: imagebase64

          },
          function(data, status){
            
            for (var i = 0; i < data.length; i++) {
              if (data[i] == 1) {
                greenMessage("Всичко е записано в базата данни ");

                $('input[name=name]').val('');
                $('input[name=fName]').val('');
                $('input[name=email]').val('');
                $('input[name=password]').val('');
                $('input[name=phone]').val('');

              }else if(data[i] == 2)
              {
                redMessage("Моля попълнете всички полета")


              }else if(data[i] == 3){
                redMessage("Вече има ученик със такъв email адрес и телефон");

              }
              else if(data[i] == 4){
                  redMessage("Email адреса вече е зает");
              }
              else if(data[i] == 5){
                  redMessage("Телефонът е зает от друг ученик");

              }
              else if (data[i] == 6){
                  redMessage("Моля въведете валиден email адрес");

              }
               if (data[i] == 7){
                  redMessage("Дължината на телефона трябва да е 10 символа");


              }
              if (data[i] == 8) {
                redMessage("Дължината на паролата трябва да е поне 6 символа");
              }
            }

          });
    });

    //upload functionality, move to different file when ready
    $(".upload-image").mouseover(function() {
      $(".teacher-icon").css("opacity", "0.3");
      $(".upload-image").css("opacity", "1");
    }).mouseleave(function() {
      $(".teacher-icon").css("opacity", "1");
      $(".upload-image").css("opacity", "0");
    });

    $(".upload-image").click(function() {
      $('#fileinput').trigger('click');
    });


    function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              var image = document.createElement('img');
              image.src = e.target.result;
              imagebase64 = e.target.result;
              image.addEventListener('load', function() {
                if(image.height === image.width) {
                  $('.teacher-icon').attr('src', e.target.result);
                } else {
                  //alert("Пропорциите на снимката трябва да са 1:1! Пример: 512x512; Вашите размери са " + image.width + "x" + image.height)

                    $.notify({
  	                   // options
                       icon: 'glyphicon glyphicon-warning-sign',
  	                   message: "Пропорциите на снимката трябва да са 1:1! Пример: 512x512; Вашите размери са " + image.width + "x" + image.height
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
              });
            }

            reader.readAsDataURL(input.files[0]);
          }
        }

    $("#fileinput").change(function(){
      readURL(this);
    });

  </script>
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>© SPanel.BG 2017-<?php echo date("Y"); ?></small><div style="font-size: 10px; line-height: 27px; position: absolute; bottom: 0; right: 10px;">Icons made by <a href="http://www.freepik.com" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a><br> licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
        </div>
      </div>
    </footer>
    <?php include "../../includes/template/scripts.php"; ?>
    <script src="<?php echo ROOT_URL; ?>includes/js/bootstrap-notify.min.js" charset="utf-8"></script>
  </div>
</body>

</html>
