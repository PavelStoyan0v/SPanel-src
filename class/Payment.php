<?php
  class Payment
  {
      private $id;
      private $method;
      private $date;
      private $email;
      private $address;
      private $phone;
      private $company;
      private $bulstat;
      private $recipient;

      public function Payment($method, $date, $email, $address, $phone, $company, $bulstat, $recipient)
      {
        $this->setMethod($method);
        $this->setDate($date);
        $this->setEmail($email);
        $this->setAddress($address);
        $this->setPhone($phone);
        $this->setCompany($company);
        $this->setBulstat($bulstat);
        $this->setRecipient($recipient);
      }

      public function getId()
      {
          return $this->id;
      }

      public function setId($id)
      {
          $this->id = $id;
      }

      public function getMethod()
      {
          return $this->method;
      }

      public function setMethod($method)
      {
          $this->method = $method;
      }

      public function getDate()
      {
          return $this->date;
      }

      public function setDate($date)
      {
          $this->date = $date;
      }

      public function getEmail()
      {
          return $this->email;
      }

      public function setEmail($email)
      {
          $this->email = $email;
      }

      public function getAddress()
      {
          return $this->address;
      }

      public function setAddress($address)
      {
          $this->address = $address;
      }

      public function getPhone()
      {
          return $this->phone;
      }

      public function setPhone($phone)
      {
          $this->phone = $phone;
      }

      public function getCompany()
      {
          return $this->company;
      }

      public function setCompany($company)
      {
          $this->company = $company;
      }

      public function getBulstat()
      {
          return $this->bulstat;
      }

      public function setBulstat($bulstat)
      {
          $this->bulstat = $bulstat;
      }

      public function getRecipient()
      {
          return $this->recipient;
      }

      public function setRecipient($recipient)
      {
          $this->recipient = $recipient;
      }
  }


?>
