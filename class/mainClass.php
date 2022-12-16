<?php
session_start();
include_once ("model.php");
class MainClass
{

  function isValid()
  {
    //Look if the person is in database
    $dbName = "test";
    $connect = new Model();
    $conn =  $connect -> connect($dbName);
          if (isset($_POST['action']) && $_POST['action'] == 'log')
          {

                $email = $_POST['email'];
                $pass = $_POST['password'];

               if( $email != '' && $pass != '' )
                {
                  //We check whether information is in database
                    if($result = $connect->selectWithOneParametar($conn,"users","email",$email))
                    {
                         $row =$result->num_rows;
                          if ($row == 0)
                          {
                             echo "This school is not in database";
                          }else if($row ==1){
                            $sqlArr = $result->fetch_array(MYSQLI_ASSOC);
                            $_SESSION['log'] = true;
                            $_SESSION['id'] = $sqlArr["id"];
                            echo "This school is in database";
                          }
                     }
                  }
                  else
                  {
                    echo "The fields is empty";
                  }
              }
         }

  function setRegistration()
  {
      $dbName = "test";
      $connect = new Model();
      $conn =  $connect -> connect($dbName);

     if (isset($_POST['action']) && $_POST['action'] == 'registration')
     {
         $name = $connect -> securiteInformation($conn,'name');
         $fName = $connect -> securiteInformation($conn,'fName');
         $email = $connect -> securiteInformation($conn,'email');
         $pass =  $connect -> securiteInformation($conn,'pass');
         $phone = $connect -> securiteInformation($conn,'phone');
         $school = $connect -> securiteInformation($conn,'school');

         if($name != '' && $fName != '' && $email != '' && $pass != '' && $phone != '' && $school != '' )
         {
           if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

             if($result =$connect->selectWithTwoParametar($conn,"users","email",$email,"school",$school))
             {
               $row =$result->num_rows;
                 if ($row == 0)
                 {
                   $options =
                      [
                         'cost' => 12,
                     ];
                   $pass2 =password_hash($pass, PASSWORD_BCRYPT,$options);
                   mysqli_query($conn,'SET NAMES utf8');
                   //Set of the user
                    $sql = mysqli_query($conn,"INSERT INTO users( `name`, `fName`, `email`, `pass`, `phone`, `school`) VALUES( '$name' ,'$fName','$email','$pass2','$phone','$school') ");
                    //Get of the id

                      $selectId = $connect->selectWithOneParametar($conn,"users","email",$email);
                      $sqlArr = $selectId->fetch_array(MYSQLI_ASSOC);
                      $tableId = $sqlArr["id"];

                      //Create a database
                        $dbName = 'user_'.(string)$tableId.'';
                        $createDb = "CREATE DATABASE $dbName CHARACTER SET utf8 COLLATE utf8_general_ci";
                        $addDb = mysqli_query($conn,"UPDATE `users`SET db = '$dbName' WHERE id = '$tableId' " );
                        if (mysqli_query($conn, $createDb)) {

                        } else {
                            echo "Error creating table: " . mysqli_error($conn);
                        }
                        //Set coockie
                         $_SESSION['log'] = true;


                         $_SESSION['id'] = $sqlArr["id"];
                         echo "rigth";
                       } else if ($row == 1)
                        {

                            $em = $connect->selectWithOneParametar($conn,"users","email",$email);
                            $sc = $connect->selectWithOneParametar($conn,"users","school",$school);
                              $validEmail =$em->num_rows;
                              $validaSchool =$sc->num_rows;

                            if($validEmail == 1 && $validaSchool ==1)
                            {
                              echo 'email and school != valid';


                            }else if ($validaSchool ==1)
                            {
                              echo 'school != valid';
                            }else if($validEmail == 1 )
                            {
                              echo 'email != valid';

                            }

                        }else if ($row == 2)
                        {
                          echo "email and school";
                        }
               }
           }else {
             echo "incorect email";
           }
         }else if($name == '' && $fName == '' && $email == '' && $pass == '' && $phone == '' && $school == ''  ) {
              echo "all = null";
            }
            else
            {
               if($name == '')
            {
              echo "name = null";
            }
             if($fName == '')
            {
              echo "fName = null";
            }
             if($email == '')
            {
              echo "email = null";
            }
             if($pass == '')
            {
              echo "pass = null";
            }
             if($phone == '')
            {
              echo "phone = null";
            }
             if($school == '')
            {
              echo "school = null";
            }
          }
     }


  }

       function addTeach()
        {
          if (isset($_POST['action']) && $_POST['action'] == 'add')
          {
            $dbName = "test";
            $connect = new Model();
            $conn =  $connect -> connect($dbName);


            $name =  $connect -> securiteInformation($conn,'name');
            $fName =  $connect -> securiteInformation($conn,'fName');
            $email =  $connect -> securiteInformation($conn,'email');
            $pass =  $connect -> securiteInformation($conn,'pass');
            $phone = $connect -> securiteInformation($conn,'phone');
            $subject =  $connect -> securiteInformation($conn,'subject');


            if($name != '' && $fName != '' && $email != '' && $pass != '' && $phone != '' && $subject != '' )
            {
              if (filter_var($email, FILTER_VALIDATE_EMAIL))
               {



                if($result = $connect ->selectWithTwoParametar($conn,"users","email",$email,"name",$name ))
                {

                  $row =$result->num_rows;
                    if ($row == 0)
                    {
                      mysqli_query($conn,'SET NAMES utf8');
                        $id = $_SESSION["id"];
                      $selectId = $connect->selectWithOneParametar($conn,"users","id",$id);

                      $sqlArr = $selectId->fetch_array(MYSQLI_ASSOC);
                      $schoolName = $sqlArr["school"];
                      $dbName = $sqlArr["db"];
                      $conn2 = $connect -> connect($dbName);
                      mysqli_query($conn2,'SET NAMES utf8');
                      if($res =  $connect ->selectWithOneParametar($conn,"teachers","email",$email))
                        $options =
                           [
                              'cost' => 12,
                          ];
                        $pass2 =password_hash($pass, PASSWORD_BCRYPT,$options);
                         //Set of the user
                         //Get of the id


                          $db = "test";
                          $table = "id";
                          $id = $_SESSION["id"];

                          if(!$conn2){
                            echo "dont connect";
                          }
                            $addIntoMainDirectory = mysqli_query($conn,"INSERT INTO `teachers`( `name`, `fName`, `email`, `pass`,`school`) VALUES( '$name' ,'$fName','$email','$pass2','$schoolName') ");
                            $add = mysqli_query($conn2,"INSERT INTO `teacher`( `name`, `fName`, `email`, `password`, `phone`, `subject`) VALUES( '$name' ,'$fName','$email','$pass2','$phone','$subject') ");
                             if(!$add){
                               var_dump($add);
                               echo "dont wraaite";
                             }else {
                               echo "all is inserted";
                             }

                              echo "rigth";
                    }else {
                        echo "string";
                    }


                  }else {
                    echo "kk";
                  }
                }else {
                  echo "incorect email";
                }
              }else if($name == '' && $fName == '' && $email == '' && $pass == '' && $phone == '' && $subject == ''  ) {
                   echo "all = null";
                 }
                 else
                 {
                    if($name == '')
                 {
                   echo "name = null";
                 }
                  if($fName == '')
                 {
                   echo "fName = null";
                 }
                  if($email == '')
                 {
                   echo "email = null";
                 }
                  if($pass == '')
                 {
                   echo "pass = null";
                 }
                  if($phone == '')
                 {
                   echo "phone = null";
                 }
                  if($subject == '')
                 {
                   echo "school = null";
                 }
               }
             }
          }



          function addClasses()
          {
            if (isset($_POST['action']) && $_POST['action'] == 'add')
            {


              $connect = new Model();
              $conn =  $connect -> connect("test");
              $classes = $connect -> securiteInformation($conn,'classes');
              $classTeacher = $connect -> securiteInformation($conn,'classTeacher');
              $numberOfStudent = $connect -> securiteInformation($conn,'number');
              $specialty = $connect -> securiteInformation($conn,'specialty');

              if($classes != '' && $numberOfStudent != '' && $classTeacher != '' && $specialty != '' )
              {

                      //Set id and database connection
                     $id = $_SESSION["id"];

                     $table = "id";
                     $dbName = "test";
                     $connect = new Model();
                     //Connect to DATABASE
                     $conn =  $connect -> connect($dbName);

                     $selectId = $connect->selectWithOneParametar($conn,"users","id",$id);

                     $sqlArr = $selectId->fetch_array(MYSQLI_ASSOC);
                     $dbName = $sqlArr["db"];

                     $conn2 =  $connect -> connect($dbName);
                     if(!$conn2){
                       echo "dont connect";
                      }
                      $namesOfTeacher = explode(" ", $classTeacher);
                      var_dump($namesOfTeacher);

                 //If classTeacher is in table- teacher
              if($findTeacher = mysqli_query($conn2,"SELECT * FROM `teacher` WHERE   fName = '$namesOfTeacher[1]' OR name = '$namesOfTeacher[0]'")){
                //if class and teache is in table - classes
                  if($result = mysqli_query($conn2,"SELECT * FROM `classes` WHERE   class = '$classes' OR name = '$namesOfTeacher[0] '"))
                  {
                    $row =$result->num_rows;
                      if ($row == 0)
                      {
                              //Set utf
                            mysqli_query($conn2,'SET NAMES utf8');

                            $add = mysqli_query($conn2,"INSERT INTO `classes`( `class`, `numberOfStudent`, `name`,`fName`, `specialty`) VALUES( '$classes' ,'$numberOfStudent','$namesOfTeacher[0]','$namesOfTeacher[1]','$specialty') ");
                             if(!$add){
                               var_dump($add);
                               echo "dont wraaite";
                             }

                              //Set classTeacher
                              $checkClassTeacher = mysqli_query($conn2,"UPDATE `teacher` SET `classTeacher`= 'Yes' WHERE name = '$namesOfTeacher[0]' OR fName = '$namesOfTeacher[1]'");
                                $checkClass = mysqli_query($conn2,"UPDATE `teacher` SET `class`= '$classes' WHERE name = '$namesOfTeacher[0]' OR fName = '$namesOfTeacher[1]'");
                              if(!$checkClassTeacher){
                                var_dump($checkClassTeacher);
                                echo "Нице";
                                 mysqli_error($conn2);
                                echo $namesOfTeacher[0];
                                echo $namesOfTeacher[1];
                              }
                              //Create a table for the class
                            $student = "CREATE TABLE $classes (
                              id INT NOT NULL AUTO_INCREMENT,
                             name VARCHAR(130) NOT NULL,
                                fName VARCHAR(130) NOT NULL,
                                email VARCHAR(150),
                                password varchar(110),
                                phone varchar(110),
                                classTeacher varchar(110),
                                subject varchar(110),
                                db varchar(110),
                                primary key (id)
                              )";

                                $addTeacher =  mysqli_query($conn2,"INSERT INTO '$classes' ('classTeacher') VALUES('$classTeacher')");
                              if (mysqli_query($conn2, $student)) {
                                  echo "Table studetns created successfully";
                              } else {
                                  echo "Error creating table: " . mysqli_error($conn2);
                              }
                          } else if ($row == 1)
                                 {
                                     $cl = mysqli_query($conn2,"SELECT * FROM classes Where class = '$classes'");
                                     $ct = mysqli_query($conn2,"SELECT * FROM classes Where  classTeacher = $classTeacher ");
                                       $validClass =$cl->num_rows;
                                       $validClassTeacher =$ct->num_rows;

                                     if($validClass  == 1 && $validClassTeacher ==1)
                                     {
                                       echo 'class and classTeacher != valid';

                                     }else if ($validClass ==1)
                                     {
                                       echo 'class';
                                     }else if($validClassTeacher == 1 )
                                     {
                                       echo 'classTeacher';

                                     }

                                 }else if ($row == 2)
                                 {
                                   echo "class and classTracher";
                                 }

                 }else
                 {
                   echo "string";
                 }
               }
             }
           }
        }

        function addStudents()
        {
          if (isset($_POST['action']) && $_POST['action'] == 'add')
          {
            $dbName = "test";
            $connect = new Model();
            $conn =  $connect -> connect($dbName);


            $name =  $connect -> securiteInformation($conn,'name');
            $fName =  $connect -> securiteInformation($conn,'fName');
            $email =  $connect -> securiteInformation($conn,'email');
            $pass =  $connect -> securiteInformation($conn,'pass');
            $phone = $connect -> securiteInformation($conn,'phone');
            $class = $connect -> securiteInformation($conn,'classes');
            if($name != ''&& $fName != '' && $email != '' && $pass != '' && $phone != '' && $class != '')
            {
                mysqli_query($conn,'SET NAMES utf8');
                $id = $_SESSION["id"];
                $selectId = $connect->selectWithOneParametar($conn,"users","id",$id);

                $sqlArr = $selectId->fetch_array(MYSQLI_ASSOC);
                $schoolName = $sqlArr["school"];
                $dbName = $sqlArr["db"];
                $conn2 = $connect -> connect($dbName);
                mysqli_query($conn2,'SET NAMES utf8');
                if (($result = $connect ->selectWithOneParametar($conn,"students","email",$email)) )
                {


                        $options =
                           [
                              'cost' => 12,
                          ];
                        $tableName = $class.'_'.$name;
                        $pass2 =password_hash($pass, PASSWORD_BCRYPT,$options);
                        $addIntoMainDirectory = mysqli_query($conn,"INSERT INTO `students`( `name`, `fName`, `email`, `pass`, `school`) VALUES('$name','$fName','$email','$pass','$schoolName')");
                        $add = mysqli_query($conn2,"INSERT INTO `$class`( `name`, `fName`, `email`, `password`, `phone`,`db`) VALUES('$name','$fName','$email','$pass','$phone','$tableName')");
                        if (!$add) {
                          $dontHaveThisClass =mysqli_error($conn2) ;
                          echo $dontHaveThisClass   ;
                        }else {
                          echo "$class[0]";
                        }

                        if($class[0] == '1')
                        {

                          $student = "CREATE TABLE $tableName (
                              id INT NOT NULL AUTO_INCREMENT,
                              bulgarian INT(1) ,
                              homeland INT(1) ,
                              math INT(1),
                              music INT(1),
                              technology INT(1),
                              appliances INT(1),
                              paint INT(1),
                              english INT(1),
                              trafficSafety INT(1),
                              primary key (id)
                            )";
                            $sql =mysqli_query($conn2, $student);


                        }else  if($class[0] == '2')
                          {

                            $student = "CREATE TABLE $tableName (
                                id INT NOT NULL AUTO_INCREMENT,
                                bulgarian INT(1),
                                environment INT(1) ,
                                math INT(1),
                                music INT(1),
                                speeks INT(1),
                                appliances INT(1),
                                paint INT(1),
                                english INT(1),
                                trafficSafety INT(1),
                                primary key (id)
                              )";
                            $sql =mysqli_query($conn2, $student);
                          }else  if($class[0] == '3')
                            {

                              $student = "CREATE TABLE $tableName (
                                  id INT NOT NULL AUTO_INCREMENT,
                                  bulgarian INT(1) ,
                                  literature INT(1),
                                  society INT(1),
                                  math INT(1),
                                  music INT(1),
                                  nature INT(1),
                                  appliances INT(1),
                                  paint INT(1),
                                  english INT(1),
                                  trafficSafety INT(1),
                                  primary key (id)
                                )";
                                $sql =mysqli_query($conn2, $student);
                            }else  if($class[0] == '4')
                              {

                                $student = "CREATE TABLE $tableName (
                                    id INT NOT NULL AUTO_INCREMENT,
                                    bulgarian INT(1),
                                    literature INT(1),
                                    math INT(1),
                                    music INT(1),
                                    society INT(1),
                                    nature INT(1),
                                    appliances INT(1),
                                    paint INT(1),
                                    english INT(1),
                                    teastExersize INT(1),
                                    primary key (id)
                                  )";
                                  $sql =mysqli_query($conn2, $student);
                              }else  if($class[0] == '5')
                                {

                                  $student = "CREATE TABLE $tableName (
                                      id INT NOT NULL AUTO_INCREMENT,
                                      bulgarian INT(1),
                                      literature INT(1),
                                      math INT(1),
                                      music INT(1),
                                      history INT(1),
                                      geography INT(1),
                                      nature INT(1),
                                      appliances INT(1),
                                      paint INT(1),
                                      english INT(1),
                                      teastExersize INT(1),
                                      primary key (id)
                                    )";
                                    $sql =mysqli_query($conn2, $student);
                                }else  if($class[0] == '6')
                                  {

                                      $student = "CREATE TABLE $tableName (
                                        id INT NOT NULL AUTO_INCREMENT,
                                        bulgarian INT(1),
                                        literature INT(1),
                                        math INT(1),
                                        music INT(1),
                                        history INT(1),
                                        geography INT(1),
                                        nature INT(1),
                                        appliances INT(1),
                                        paint INT(1),
                                        english INT(1),
                                        teastExersize INT(1),
                                        primary key (id)
                                      )";
                                      $sql =mysqli_query($conn2, $student);
                                  }else  if($class[0] == '7')
                                    {

                                      $student = "CREATE TABLE $tableName (
                                          id INT NOT NULL AUTO_INCREMENT,
                                          bulgarian INT(1),
                                          literature INT(1),
                                          math INT(1),
                                          music INT(1),
                                          history INT(1),
                                          geography INT(1),
                                          nature INT(1),
                                          appliances INT(1),
                                          paint INT(1),
                                          english INT(1),
                                          teastExersize INT(1),
                                          primary key (id)
                                        )";
                                        $sql =mysqli_query($conn2, $student);
                                    }else  if($class[0] == '8')
                                      {

                                        $student = "CREATE TABLE $tableName (
                                            id INT NOT NULL AUTO_INCREMENT,
                                            bulgarian INT(1),
                                            literature INT(1),
                                            math INT(1),
                                            music INT(1),
                                            history INT(1),
                                            geography INT(1),
                                            nature INT(1),
                                            appliances INT(1),
                                            paint INT(1),
                                            english INT(1),
                                            teastExersize INT(1),
                                            primary key (id)
                                          )";
                                          $sql =mysqli_query($conn2, $student);
                                      }else  if($class[0] == '9')
                                        {

                                          $student = "CREATE TABLE $tableName (
                                              id INT NOT NULL AUTO_INCREMENT,
                                              bulgarian INT(1),
                                              literature INT(1),
                                              math INT(1),
                                              music INT(1),
                                              history INT(1),
                                              geography INT(1),
                                              nature INT(1),
                                              appliances INT(1),
                                              paint INT(1),
                                              english INT(1),
                                              teastExersize INT(1),
                                              primary key (id)
                                            )";
                                            $sql =mysqli_query($conn2, $student);
                                        }

                }else{
                  var_dump( $connect ->selectWithOneParametar($conn,"students","email",$email));
                  echo  $class;
                  var_dump($conn2);
                }
          }else {
            echo "sorry for this";
          }
        }else {
          echo "wrong";
        }
      }
    }




?>
