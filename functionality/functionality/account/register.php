<?php

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="reg.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <form class="" method="post" name="">
    <i class="fa fa-user helper" aria-hidden="true"></i><input type="text" name="email" placeholder="Име." class="name" required>
    <i class="fa fa-user helper" aria-hidden="true"></i><input type="text" name="pass" placeholder="Фамилия." class="fName" required>
    <i class="fa fa-envelope helper" aria-hidden="true"></i><input type="text" name="email" placeholder="Email адрес." class="email" required>
    <i class="fa fa-unlock-alt helper" aria-hidden="true"></i><input type="password" name="pass" placeholder="Парола." class="pass" required>
    <i class="fa fa-phone helper" aria-hidden="true"></i><input type="text" name="email" placeholder="Телефон." class="phone" required>
    <i class="fa fa-graduation-cap helper" aria-hidden="true"></i><input type="text" name="pass" placeholder="Училише." class="school" required>
    <button type="button" name="button" class="btn">Вход</button>
  </form>
    <h1></h1>
  <script>
  $('.btn').click(function () {
var name = $('.name').val();
var fName = $('.fName').val();
var email = $('.email').val();
var pass = $('.pass').val();
var phone = $('.phone').val();
var school = $('.school').val();
$.post("insert.php",
    {
        action: "registration",
        name: name,
        fName: fName,
        email: email,
        pass: pass,
        phone: phone,
        school: school
    },
    function(data, status){
         alert(data);
         if (data == "rigth") {
            window.location.href = "https://spanel23.000webhostapp.com";
         }else 
         {
               
         }

    });

});

  </script>
  </body>
</html>
