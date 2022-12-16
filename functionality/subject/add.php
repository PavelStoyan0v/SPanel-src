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
               <h2 class="col-sm-12" style="text-align: center;">Нов предмет</h2>
             </div>

             <div class="row">
               <div class="input-group">
                 <span class="input-group-addon" id="basic-addon-email"><i class="fa fa-envelope"></i></span>
                 <input class="form-control col-sm-12" id="subject" type="text" name="subject" aria-describedby="basic-addon-email" placeholder="Предмет..">
               </div>
             </div>
               <button type="button" class="col-sm-12 btn btn-primary btn-lg btn-block btn-submit" id = "insert-btn-student">Добави предмет</button>
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
      var subject = $('input[name=subject]').val();

      $.post("addfunctionality.php",
          {
              action: "add",
              subject: subject
          },
          function(data, status){
              
              if (data == 1) {
                greenMessage("Всичко е записано в базата данни ");

                $('input[name=subject]').val('');


              }else if(data == 2)
              {
                redMessage("Моля попълнете всички полета")


              }else if(data == 3){
                redMessage("Този предмет е вече във базата данни");

              }
              else if(data == 4){
                  redMessage("Email адреса вече е зает");
              }
              else if(data == 5){
                  redMessage("Телефонът е зает от друг ученик");

              }
              else{
                  redMessage("Грешка при вкарването на данни в базата данни");

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
