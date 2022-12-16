<?php
  use Medoo\Medoo;

  class Subscription {
      //auto generated by mysql
      private $id;
      //string
      private $status;
      //date
      private $activated;
      //date
      private $expires;
      private $terminatedate;
      private $paymentid;

      public function getLatest($userid) {
        $userdb = new Medoo([
          'database_type' => 'mysql',
          'database_name' => 'spanelpw_user_'.$_SESSION['id'],
          'server' => DB_HOST,
          'username' => DB_USER,
          'password' => DB_PASSWORD
        ]);

        $result = $userdb->select("subscriptions", "*", [
          'ORDER' => ['activated' => 'DESC'],
          'LIMIT' => 1
        ]);

        return $result[0];
      }

      public function isActive($userid) {
        $userdb = new Medoo([
          'database_type' => 'mysql',
          'database_name' => 'spanelpw_user_'.$_SESSION['id'],
          'server' => DB_HOST,
          'username' => DB_USER,
          'password' => DB_PASSWORD
        ]);

        $result = $userdb->select("subscriptions", "*", [
          'status' => 'active'
        ]);
        $count = count($result);
        if($count > 1){
          //active subscriptions are more than 1
          return false;
          throw new Exception('Subscriptions ERROR: #1 - this is most likely an error on our side and you should contact our support!');
        }else if($count < 1){
          //there are no active subscriptions
          return false;
        }else{
          //1 active subscription, but is it expired? if it is, lets deactivate it
          //format: dd-MM-yyyy
          $expires = strtotime($result[0]['expires']);
          $now = strtotime('now');
          if($now < $expires) {
            //subscription still not expired
            return true;
          }else{
            //set subscription to expired, because it is expired and not updated
            $userdb->update("subscriptions", [
              'status' => 'expired'
            ], [
              'status' => 'active'
            ]);
            return false;
          }
        }
      }

      public function Subscription() {
        /* $status, $activated, $expires, $paymentid
        $this->$status = $status;
        $this->$activated = $activated;
        $this->$expires = $expires;
        $this->$paymentid = $paymentid;
        */
      }
  }
?>
