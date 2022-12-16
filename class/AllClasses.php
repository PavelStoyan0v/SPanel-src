<?php
  error_reporting(E_ALL);
  if(!isset($ignoresession)){
    require "Session.php";
  }
  require "Db.php";
  require "Account.php";
  require "Payment.php";
  require "Subscription.php";
  require "schoolProgram.php";
  require "AverageResults.php";
  $db = new Db();
  $school = new Program();
  $account = new Account();
  $subscription = new Subscription();
  $average = new AverageResults();
  if(!isset($subscriptioncheck)){
    if(!$subscription->isActive($id)){
      header("Location: ".ROOT_URL."subscription/expired");
    }
  }

?>
