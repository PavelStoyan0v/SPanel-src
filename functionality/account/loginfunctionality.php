<?php
  $ignoresession = true;
  $subscriptioncheck = false;
  require "../../config.php";
  require "../../vendor/autoload.php";
  require "../../class/AllClasses.php";


  if(isset($_POST["email"]) && isset($_POST["password"])){
    $email = $db->escape($_POST["email"]);
    $password = $db->escape($_POST["password"]);

    $exists = $account->exists($email, $password, $db);

    if($exists == 1){
      $user = $db->getUserByEmail($email);
      if(isset($_POST["remember"])){
        if($_POST["remember"]){
          //604 800 seconds = 1 week
          setcookie("TestCookie", "helllo", time()+21600);  /* expire in 1 hour */

        }else{
          //6 hours
          session_set_cookie_params(21600, MAIN_DIR, DOMAIN, false, true);
        }
      }
      session_start();

      $_SESSION['log'] = true;
      $_SESSION['id'] = $user["id"];
      echo "true";

    }else if($exists == 2){

      $user = $db->getUserByEmail($email);

      if(isset($_POST["remember"])){
        if($_POST["remember"]){
          //604 800 seconds = 1 week
          session_set_cookie_params(604800, MAIN_DIR, DOMAIN, false, true);
        }else{
          //6 hours
          session_set_cookie_params(21600, MAIN_DIR, DOMAIN, false, true);
        }
      }

      session_start();
      $_SESSION['log'] = true;
      $_SESSION['id'] = $user["id"];

      echo "teacher";
    }else {
      echo "false";
    }
  }
?>
