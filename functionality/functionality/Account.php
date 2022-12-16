<?php
  use Medoo\Medoo;

  class Account
  {
    public function create($name, $fname, $email, $pass, $phone, $school) {

      if(strlen($name) < 2 && strlen($fname) < 3 && strlen($email) < 1 && strlen($pass) < 6 && strlen($phone) < 10 && strlen($phone) > 13 && strlen($school) < 3) {
        return 3;
      }

      //check if the email exists in the database
      if($db->emailExists($email)){
        return 0;
      }

      //check if the phone exists in the database
      if($db->phoneExists($phone)) {
        return 2;
      }

      $hashedpass = password_hash($pass, PASSWORD_DEFAULT);

      $db->insertUser($name, $fname, $email, $hashedpass, $phone, $school);
    }

    public function exists($email, $password, $db) {
      $user = $db->getUserByEmail($email);
      if(!$user){
        return 0;
      }else{
        if(password_verify($password, $user["pass"])){
          return 1;
        }else{
          return 0;
        }
      }
    }
  }
?>
