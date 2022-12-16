<?php
   /**
    *
    */
   class Model
   {
     function connect($dbName)
     {
        return mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
     }

     function selectWithOneParametar($conn,$db,$table,$value)
     {
       return mysqli_query($conn,"SELECT * FROM $db Where $table = '$value'");
     }
     function selectWithTwoParametar($conn,$db,$table,$value,$table2,$value2)
     {
       return mysqli_query($conn,"SELECT * FROM $db Where $table = '$value' OR $table2 = '$value2'");
     }
     function showTableINDB($conn,$dbName)
     {

       return  mysqli_query($conn,"SHOW TABLES IN $dbName");

     }
     function securiteInformation($conn,$par)
     {
      return  mysqli_real_escape_string($conn,$_POST[$par]);
     }
     function selectWithThreeParametar($conn,$db,$table,$value,$table2,$value2,$table3,$value3)
     {
       return mysqli_query($conn,"SELECT * FROM $db Where $table = '$value' OR $table2 = '$value2' OR  $table3 = '$value3'");
     }

   }




 ?>
