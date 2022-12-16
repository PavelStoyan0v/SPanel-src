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
      $table = "name";

         $classTeacher =mysqli_real_escape_string($conn,$_POST['classTeacher']);
         if($classTeacher != ''){
         $conn2 = $connect -> connect($dbNames);
         mysqli_query($conn2,'SET NAMES utf8');
         $myArray = array();
        if($result = mysqli_query($conn2,"SELECT *  FROM `teacher` WHERE name Like '%$classTeacher%' OR fName LIKE '%$classTeacher%'")){

          while(($row =  mysqli_fetch_assoc($result))) {
            $fName =  $row["fName"] ;
            $name = $row["name"] ;
            $classTeacherName = "$name $fName";
            $myArray[] = $classTeacherName;

          }
            echo json_encode($myArray,JSON_UNESCAPED_UNICODE);

        }

    }else if($classTeacher == ''){
      echo "none";
    }
}
