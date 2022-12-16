<?php
session_start();
include_once ("../class/model.php");
    if (isset($_POST['action']) && $_POST['action'] == 'search')
    {

      $dbName = "test";
      $connect = new Model();
      $conn =  $connect -> connect($dbName);
      $id = $_SESSION["id"];
      $selectId = mysqli_query($conn,"SELECT * FROM users Where id = '$id'");
      $sqlArr = $selectId->fetch_array(MYSQLI_ASSOC);
      $dbNames = $sqlArr["db"];
      $db = "teacher";
     $conn2 = $connect -> connect($dbNames);
     mysqli_query($conn2,'SET NAMES utf8');
     $myArray = array();
     if($result = mysqli_query($conn2,"SELECT *  FROM `teacher`")){

       while(($row =  mysqli_fetch_assoc($result))) {


         $fName =  $row["fName"] ;
         $name = $row["name"] ;
         $email = $row["email"];
         $subject = $row["subject"];
         $phoneNum =  $row["phone"];
         $classTeacher =  $row["classTeacher"];
         $class = $row["class"];
         $classTeacherName = "$name $fName $email $phoneNum $classTeacher $class";
         $myArray[] = $classTeacherName;

       }
         echo json_encode($myArray,JSON_UNESCAPED_UNICODE);

     }
   }
