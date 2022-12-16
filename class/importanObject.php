<?php

  include_once ("model.php");
   /**
    *
    */
   class importanObject
   {

     function createATable()
     {

       $dbName = "test";
       $connect = new Model();
       $conn =  $connect -> connect($dbName);
      $id = $_SESSION["id"];
      $db = "users";
      $table = "id";
      $selectId = $connect -> selectWithOneParametar($conn,$db,$table,$id);
      var_dump($selectId);
      $sqlArr = $selectId->fetch_array(MYSQLI_ASSOC);
      $dbName = $sqlArr["db"];
      $conn2 =  $connect -> connect($dbName);
         //Create a database
         //Create a table for teacher
         $teacher = "CREATE TABLE teacher (
           id INT NOT NULL AUTO_INCREMENT,
          name VARCHAR(130) NOT NULL,
             fName VARCHAR(130) NOT NULL,
             email VARCHAR(150),
             password varchar(110),
             phone varchar(110),
             subject varchar(110),
             classTeacher varchar(110),
             primary key (id)
           )";

           if (mysqli_query($conn2, $teacher)) {
               echo "Table teacher created successfully";
           } else {
               echo "Error creating table: " . mysqli_error($conn);
           }
           //Create a table for student
           $student = "CREATE TABLE classes (
             id INT NOT NULL AUTO_INCREMENT,
            class VARCHAR(130) NOT NULL,
               numberOfStudent VARCHAR(130) NOT NULL,
               name VARCHAR(150),
               fName VARCHAR(150),
               specialty varchar(110),
               primary key (id)
             )";

             if (mysqli_query($conn2, $student)) {
                 echo "Table studetns created successfully";
             } else {
                 echo "Error creating table: " . mysqli_error($conn2);
             }


     }


     function whetherItExistsTable()
      {
        $dbName = "test";
        $connect = new Model();
        $conn =  $connect -> connect($dbName);
        $id = $_SESSION["id"];
        $db = "users";
        $table = "id";
        $value= $id;
        $selectId = $connect -> selectWithOneParametar($conn,$db,$table,$value);

        $sqlArr = $selectId->fetch_array(MYSQLI_ASSOC);
        $dbName = $sqlArr["db"];

        $conn2 = $connect -> connect($dbName);

        $sql = "SHOW TABLES IN $dbName";
        $result = mysqli_query($conn2,$sql);

        $res = mysqli_fetch_row($result) ;
        if(!$res == 2)
        {
          $a = new importanObject();
           $a -> createATable();
        }



     }

     function addlasses()
     {
       $dbName = "test";
       $connect = new Model();
       $conn =  $connect -> connect($dbName);
       $id = $_SESSION["id"];
    $selectId = $connect -> selectWithOneParametar($conn,$db,$table,$id);
       $sqlArr = $selectId->fetch_array(MYSQLI_ASSOC);
       $dbName = $sqlArr["db"];
       $conn2 =   $connect -> connect($dbName);
       $student = "CREATE TABLE  (
         id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(130) NOT NULL,
           fName VARCHAR(130) NOT NULL,
           email VARCHAR(150),
           password varchar(110),
           phone varchar(110),
           subject varchar(110),
           primary key (id)
         )";

         if (mysqli_query($conn2, $student)) {
             echo "Table studetns created successfully";
         } else {
             echo "Error creating table: " . mysqli_error($conn2);
         }

     }
   }



 ?>
