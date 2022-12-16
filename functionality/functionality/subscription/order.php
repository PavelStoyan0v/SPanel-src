<?php
  $subscriptioncheck = false;
  require "../../vendor/autoload.php";
  require "../../config.php";
  require "../../class/AllClasses.php";

  $info = $subscription->getLatest($id);
  $status = $info['status'];
  if($status == "active"){
    header("Location: ".ROOT_URL);
    exit();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <script src="<?php echo ROOT_URL; ?>vendor/jquery/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap core CSS-->
    <link href="<?php echo ROOT_URL; ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="<?php echo ROOT_URL; ?>vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="<?php echo ROOT_URL; ?>vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="<?php echo ROOT_URL; ?>includes/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ROOT_URL; ?>includes/css/order.css">
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <meta charset="utf-8">
    <title>SPanel | Подновяване на абонамент.</title>
  </head>
  <body>
    <div class="container">
      <img class="logo" src="<?php echo ROOT_URL; ?>includes/img/logo_original.png" alt="">
      <h1>Подновяване на абонамент <i class="fa fa-cog fa-spin fa-3x fa-fw" style="font-size: 44px;"></i></h1>
      <div class="card">
        <h3 class="card-header"><span class="title">Изберете метод на плащане</span><span class="user"><i class="fa fa-user-circle" aria-hidden="true"></i> <?php echo $db->getFullNameById($id); ?></span></h3>
        <div class="card-block">
          <hr>
          <div class="content">

          </div>
          <hr>
          <div class="controls">
            <button class="btn btn-primary btn-back" expiredpage="<?php echo ROOT_URL; ?>subscription/expired"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button>
            <button class="btn btn-primary btn-forward">Продължи <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
          </div>
        </div>
      </div>
    </div>
    <script src="<?php echo ROOT_URL; ?>vendor/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo ROOT_URL; ?>vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="<?php echo ROOT_URL; ?>includes/js/order.js"></script>
  </body>
</html>
