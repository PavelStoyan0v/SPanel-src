<?php
  $ignoresession = true;
  $subscriptioncheck = false;
  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";
  ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include "../../includes/template/headincludes.php"; ?>
    <title>SPanel Login page</title>
  </head>
   <body>
    <div class="wrapper-login">
      <form class="form-login" method="post">
        <h2 class="form-login-heading">Вход в SPanel</h2>
        <input type="text" class="form-control" name="username" placeholder="Email адрес" required autofocus />
        <input type="password" class="form-control" name="password" placeholder="Парола" required=/>
        <span class="spacing"></span>
        <label class="checkbox">
          <input type="checkbox" value="remember-me" id="rememberMe" name="remember"> Запомни ме
        </label>
        <div class="alert alert-danger form-alert">
          Грешни данни за вход!
        </div>
        <button class="btn btn-lg btn-primary btn-block">Влез</button>
      </form>
    </div>
    <script src="<?php echo ROOT_URL ?>includes/js/login.js" charset="utf-8"></script>
  </body>
</html>
