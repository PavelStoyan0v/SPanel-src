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
    <!-- Bootstrap core CSS-->
    <link href="<?php echo ROOT_URL; ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="<?php echo ROOT_URL; ?>vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="<?php echo ROOT_URL; ?>vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="<?php echo ROOT_URL; ?>includes/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ROOT_URL; ?>includes/css/expired.css">
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="container">
      <img class="logo" src="<?php echo ROOT_URL; ?>includes/img/logo_original.png" alt="">
      <?php
        if($status == "expired") {
          $displaystatus = "изтекъл";
        }else if($status == "terminated") {
          $displaystatus = "<span class='terminated'>терминиран</span>";
        }else if($status == "deactivated") {
          $displaystatus = "<span class='terminated'>деактивиран</span>";
        }else{
          $displaystatus = "активен";
        }
      ?>
      <h1>Вашият абонамент е <?php echo $displaystatus; ?>.</h1>
      <div class="card">
        <h3 class="card-header">Детайли <span class="user"><i class="fa fa-user-circle" aria-hidden="true"></i> <?php echo $db->getFullNameById($id); ?></span></h3>
        <div class="card-block">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Абонамент &#8470;</th>
                <th>Статус</th>
                <th>Дата на активиране</th>
                <th>Дата на изтичане</th>
                <th>Дата на терминиране</th>
              </tr>
            </thead>
            <tbody >
              <tr>
                <?php
                  echo "<th>".$info['id']."</th>";
                  switch ($status) {
                    case 'active':
                      echo "<th><span class='active'>активен</span></th>";
                      break;
                    case 'deactivated':
                      echo "<th>деактивиран от администратор</th>";
                      break;
                    case 'terminated':
                      echo "<th><span class='terminated'>терминиран</span></th>";
                      break;
                    case 'expired':
                      echo "<th><span class='expired'>изтекъл</span></th>";
                      break;
                    default:
                      echo "<th>деактивиран от администратор</th>";
                      break;
                  }
                  echo "<th>".$info['activated']."</th>";

                  $expires = date_create($info['expires'])->format('d-m-Y');
                  echo "<th>".$expires."</th>";

                  $terminatedate = date_create($info['expires'])->add(new DateInterval("P1M"))->format('d-m-Y');
                  echo "<th>".$terminatedate."</th>";
                ?>
              </tr>
            </tbody>
          </table>
          <?php

           ?>
          <a href="<?php echo ROOT_URL; ?>subscription/order" class="btn btn-primary renew">Поднови абонамент</a>
          <a href="<?php echo ROOT_URL; ?>account/logout" class="btn btn-primary logout">Излез от акаунт</a>
        </div>
      </div>
      <?php
        if($status == "expired"){
          echo '<div class="alert alert-warning"><strong>Важно!</strong> Данните ви ще бъдат загубени перманентно след датата на терминиране. Подновете абонаментът си, за да ги запазите.</div>';
        }else{
          echo '<div class="alert alert-danger">Вашият абонамент е <strong>терминиран</strong>. Можете да се абонирате отново, но данните ви са изтрити и няма как да бъдат възтановени!</div>';
        }
      ?>

    </div>

    <script src="<?php echo ROOT_URL; ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo ROOT_URL; ?>vendor/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo ROOT_URL; ?>vendor/datatables/dataTables.bootstrap4.js"></script>
  </body>
</html>
