<?php

  use Medoo\Medoo;


  class Program
  {

     public function schoolProgram($userId, $studentId, $class){
      switch ($class[0]) {
        case '1':
          $this ->firstGrade($userId, $studentId, $class);
          break;

        case '2':
            secondGrade($userId, $studentId, $class);
            break;

        case '3':
          thirthGrade($userId, $studentId, $class);
          break;

        case '4':
            $this->fourthGrade($userId, $studentId, $class);
            break;

        case '5':
          fifthAndSixthGrade($userId, $studentId, $class);
          break;

        case '6':
          fifthAndSixthGrade($userId, $studentId, $class);
          break;

        case '7':
          seventhAndEightGrade($userId, $studentId, $class);
          break;

        case '8':
          seventhAndEightGrade($userId, $studentId, $class);
          break;

        default:
          # code...
          break;
      }

    }
     function userDb($userId){
        return $dbName = $db->userdb($userId);
    }


     function firstGrade($userId, $name, $class){
        userConnect($userId);
        $dbName = $class + "_" + $name;

        $userdb->query(
          "CREATE TABLE `$dbname` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `bulgarian` varchar(130) NOT NULL,
          `homeland` varchar(130) NOT NULL,
          `math` varchar(150) DEFAULT NULL,
          `music` varchar(110) DEFAULT NULL,
          `technology` varchar(110) DEFAULT NULL,
          `appliances` varchar(110) DEFAULT NULL,
          `art` varchar(110) DEFAULT NULL,
          `english` varchar(110) DEFAULT NULL,
          `trafficSafety` varchar(110) DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
          ");

    }

     function secondGrade($userId, $name, $class){
        userConnect($userId);
        $dbName = $class + "_" + $name;

        $userdb->query(
          "CREATE TABLE `$dbname` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `bulgarian` varchar(130) NOT NULL,
          `math` varchar(150) DEFAULT NULL,
          `music` varchar(110) DEFAULT NULL,
          `environment` varchar(130) NOT NULL,
          `art` varchar(110) DEFAULT NULL,
          `appliances` varchar(110) DEFAULT NULL,
          `english` varchar(110) DEFAULT NULL,
          `speechDevelopment` varchar(110) DEFAULT NULL,
          `trafficSafety` varchar(110) DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
          ");

    }

     function thirthGrade($userId, $name, $class){
        userConnect($userId);
        $dbName = $class + "_" + $name;

        $userdb->query(
          "CREATE TABLE `$dbname` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `bulgarian` varchar(130) NOT NULL,
          `math` varchar(150) DEFAULT NULL,
          `music` varchar(110) DEFAULT NULL,
          `society` varchar(130) NOT NULL,
          `nature` varchar(110) DEFAULT NULL,
          `appliances` varchar(110) DEFAULT NULL,
          `art` varchar(110) DEFAULT NULL,
          `english` varchar(110) DEFAULT NULL,
          `trafficSafety` varchar(110) DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
          ");

    }

      public function fourthGrade($userId, $studentId, $class){


            $userdb = $db->userdb($userId);
            $studentTabe = $class."_".$studentId;

            $userdb->query(
            "CREATE TABLE `$studentDb` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `bulgarian` int(130) NOT NULL,
            `math` int(150) DEFAULT NULL,
            `music` int(110) DEFAULT NULL,
            `society` int(130) NOT NULL,
            `nature` int(110) DEFAULT NULL,
            `appliances` int(110) DEFAULT NULL,
            `art` int(110) DEFAULT NULL,
            `english` int(110) DEFAULT NULL,
            `testТasks` int(110) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            ");

             $userdb->query(
                "CREATE TABLE `$studentDb` (
                `id` int(11) NOT NULL,
                `bulgarian` int(50) ,
                `math` int(50) ,
                `music` int(11) ,
                `society` int(11),
                `nature` int(20) ,
                `appliances` int(200),
                `art` int(20) ,
                `english` int(100) ,
                'testTask' int(100))
                  ENGINE=InnoDB DEFAULT CHARSET=utf8;
              ");
      }

     function fifthAndSixthGrade($userId, $name, $class){
        userConnect($userId);
        $dbName = $class + "_" + $name;

        $userdb->query(
          "CREATE TABLE `$dbname` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `bulgarian` varchar(130) NOT NULL,
          `literature` varchar(130) NOT NULL,
          `math` varchar(150) DEFAULT NULL,
          `music` varchar(110) DEFAULT NULL,
          `Geography` varchar(130) NOT NULL,
          `history` varchar(110) DEFAULT NULL,
          `technology` varchar(110) DEFAULT NULL,
          `art` varchar(110) DEFAULT NULL,
          `appliances` varchar(110) DEFAULT NULL,
          `nature` varchar(110) DEFAULT NULL
          `english` varchar(110) DEFAULT NULL,
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
          ");

    }

     function seventhAndEightGrade($userId, $name, $class){
        userConnect($userId);
        $dbName = $class + "_" + $name;

        $userdb->query(
          "CREATE TABLE `$dbname` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `bulgarian` varchar(130) NOT NULL,
          `literature` varchar(130) NOT NULL,
          `math` varchar(150) DEFAULT NULL,
          `music` varchar(110) DEFAULT NULL,
          `Geography` varchar(130) NOT NULL,
          `history` varchar(110) DEFAULT NULL,
          `biology` varchar(110) DEFAULT NULL,
          `chemistri` varchar(110) DEFAULT NULL,
          `physics` varchar(110) DEFAULT NULL,
          `technology` varchar(110) DEFAULT NULL,
          `art` varchar(110) DEFAULT NULL,
          `appliances` varchar(110) DEFAULT NULL,
          `english` varchar(110) DEFAULT NULL,
          `russian` varchar(110) DEFAULT NULL,
          `german` varchar(110) DEFAULT NULL,
          `french` varchar(110) DEFAULT NULL,
          `trafficSafety` varchar(110) DEFAULT NULL,
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
          ");

      }
    }

 ?>
