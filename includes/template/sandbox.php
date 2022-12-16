<?php
  $subscriptioncheck = false;
  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";

  $user = $db->getUserById($id);
?>

<p class="info">Цена: <b>14.99лв.</b></p>
<p class="info">Email: <b><?php echo $user['email']; ?></b></p>
<p class="info">Име: <b><?php echo $user['name']; ?></b></p>
<p class="info">Фамилия: <b><?php echo $user['fName']; ?></b></p>
