<?php

  use Medoo\Medoo;

  class Db
  {
    public function connect(){
      $database = new Medoo([
        'database_type' => 'mysql',
        'database_name' => DB_DATABASE,
        'server' => DB_HOST,
        'username' => DB_USER,
        'password' => DB_PASSWORD
      ]);

      return $database;
    }

    public function userdb($id){
      $database = new Medoo([
        'database_type' => 'mysql',
        'database_name' => 'spanelpw_user_'.$id,
        'server' => DB_HOST,
        'username' => DB_USER,
        'password' => DB_PASSWORD
      ]);

      return $database;
    }

    public function insertSubscription($status, $activated, $expires, $userid){
      $db = $this->userdb($userid);

      $db->insert("subscriptions", [
        'status' => $status,
        'activated' => $activated,
        'expires' => $expires,
      ]);

      $subscriptionid = $db->id();
      return $subscriptionid;
    }

    public function insertPayment($payment, $user) {
      $userid = $user['id'];
      $db = $this->userdb($userid);

      $db->insert("payments", [
        'method' => $payment->getMethod(),
        'date' => $payment->getDate(),
        'email' => $payment->getEmail(),
        'address' => $payment->getAddress(),
        'phone' => $payment->getPhone(),
        'company' => $payment->getCompany(),
        'bulstat' => $payment->getBulstat(),
        'recipient' => $payment->getRecipient(),
      ]);

      $paymentid = $db->id();
      return $paymentid;
    }

    public function escape($string) {
      $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
      return mysqli_real_escape_string($link, $string);
    }
    public function getUserByEmail($email) {
      $database = $this->connect();

      $result = $database->select("users", "*", [
        'email' => $email
      ]);

      if(count($result) < 1){
        return false;
      }else{
        return $result[0];
      }
    }

    public function getUserById($id) {
      $database = $this->connect();

      $user = $database->select("users", "*", [
        'id' => $id
      ]);
      return $user[0];
    }

    public function getFullNameById($id) {
      $user = $this->getUserById($id);
      return htmlspecialchars($user['name']." ".$user['fName']);
    }

    public function emailExists($email) {
      $database = $this->connect();

      $count = count($database->select("users", "email", [
        'email' => $email
      ]));

      if($count < 1){
        return false;
      }else{
        return true;
      }
    }



    public function phoneExists($phone) {
      $database = $this->connect();

      $count = count($database->select("users", "phone", [
        'phone' => $phone
      ]));
      if($count < 1){
        return false;
      }else{
        return true;
      }
    }

    public function insertUser($name, $fname, $email, $pass, $phone, $school) {
      $database = $this->connect();

      $database->insert("users", [
        'name' => $name,
        'fName' => $fname,
        'email' => $email,
        'pass' => $pass,
        'phone' => $phone,
        'school' => $school
      ]);

      $userid = $database->id();
      $dbName = "spanelpw_user_".$userid;
      $database->query("CREATE DATABASE $dbName CHARACTER SET utf8 COLLATE utf8_general_ci");

      $database->update("users", [
        'db' => $dbName
      ], [
        'id' => $userid
      ]);

      $userdb = new $this->userdb($userid);

      $userdb->query(
          "CREATE TABLE `classes` (
                `id` int(11) NOT NULL,
                `teacher_id` int(50) NOT NULL,
                `subject` varchar(111) NOT NULL,
                `class` varchar(111) NOT NULL
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
          ") ;

      $userdb->query(
        "CREATE TABLE `payments` (
        `id` int(11) NOT NULL,
        `method` varchar(50) NOT NULL DEFAULT 'cash',
        `date` date NOT NULL,
        `email` varchar(300) NOT NULL,
        `address` varchar(300) NOT NULL,
        `phone` varchar(20) NOT NULL,
        `company` varchar(200) NOT NULL,
        `bulstat` varchar(20) NOT NULL,
        `recipient` varchar(100) NOT NULL)
        ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");

      $userdb->query(
        "CREATE TABLE `subscriptions` (
        `id` int(11) NOT NULL,
        `status` varchar(15) NOT NULL DEFAULT 'active',
        `activated` date NOT NULL,
        `expires` date NOT NULL,
        `paymentid` int(11) NOT NULL)
        ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");

      $userdb->query(
        "CREATE TABLE `teacher` (
              `id` int(11) NOT NULL,
              `name` varchar(130) NOT NULL,
              `fName` varchar(130) NOT NULL,
              `email` varchar(150) DEFAULT NULL,
              `password` varchar(110) DEFAULT NULL,
              `phone` varchar(110) DEFAULT NULL,
              `subject` varchar(110) DEFAULT NULL,
              `secondSubject` varchar(64) NOT NULL,
              `classTeacher` varchar(110) DEFAULT NULL,
              `img` mediumtext NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");

        $userdb->query(
          "CREATE TABLE `results` (
                `id` int(111) NOT NULL,
                `teacher_Id` int(111) NOT NULL,
                `student_id` int(111) NOT NULL,
                `subject` varchar(112) NOT NULL,
                `result` int(112) NOT NULL
              ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
          ");

          $userdb->query(
            "CREATE TABLE `students` (
                `id` int(111) NOT NULL,
                `name` varchar(111) NOT NULL,
                `fName` varchar(111) NOT NULL,
                `email` varchar(111) NOT NULL,
                `pass` varchar(111) NOT NULL,
                `class` varchar(11) NOT NULL,
                `phone` int(11) NOT NULL,
                `img` mediumblob NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
          ");

          $userdb->query(
              "CREATE TABLE `subjects` (
                    `id` int(50) NOT NULL,
                    `subject` varchar(40) NOT NULL
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
          ");
      }


    public function insertTeacher($userId, $name, $fName, $email, $pass, $phone, $subject,$secondSubject,$img){
        $db = $this->connect();
        $userDb = $this->userdb($userId);

        $getSubject = $userDb->select("subjects", "*", [
          'subject' => $subject
        ]);

        if(count($getSubject) > 0)
        {

          if (strlen($secondSubject) > 2)
           {

              $getSecondSubject = $userDb->select("subjects", "*", [
                'subject' => $secondSubject
              ]);

              if (count($getSecondSubject) == 0) {
                //second subject is not in databse
                var_dump($secondSubject);
                return 4;
              }else {
                $subject = $getSecondSubject[0]["id"];
              }
           }else {
             $subject = "";
           }
           $setUser = $db->insert("users", [
            'name' => $name,
            'fName' => $fName,
            'email' => $email,
            'pass' => $pass,
            'phone' => $phone,
            'db' => 'spanelpw_user_'.$userId,
            'admin'=> 'No',
          ]);

           $setTeacher = $userDb->insert("teacher", [
            'name' => $name,
            'fName' => $fName,
            'email' => $email,
            'password' => $pass,
            'phone' => $phone,
            'subject' => $getSubject[0]["id"],
            'secondSubject' => $subject,
            'classTeacher' => 'No',
            'img' => $img
          ]);

          if($setTeacher && $setUser)
          {
            //all is inserted
            return 1;
          }
          else
          {
            //have samething wrong
            return 0;
          }
      }

      else
       {
         //the subject isn in the database
         return 3;

      }
    }

    public function insertClass($userId, $name, $fName, $subject, $class){
      $db = $this->connect();
      $userDb  = $this->userdb($userId);


      $getTeacherId = $db->select("users", "*", [
        'name' => $name,
        'fName' =>$fName,
      ]);

      $getSubject = $userDb->select("subjects", "*", [
        'subject' => $subject
      ]);

      if(count($getSubject) > 0 )
      {
          if (count($getTeacherId) != 0)
          {
              //insert the class in database
              $setClass = $userDb->insert("classes", [
                 'teacher_Id' => $getTeacherId[0]["id"],
                 'subject' => $getSubject[0]["id"],
                 'class' => $class
               ]);
               //update colum calssTeacher from "NO" to "Yes"
               $updateTeacher = $userDb->update("teacher",["classTeacher" => 'Yes'], ["id" => $getTeacherId[0]["id"]]);
               if ($setClass && $updateTeacher)
               {
                 //all is inserted in database
                 return 1;
               }
               else
               {
                 //cannt insert in database
                 return 0;
               }
           }
           else
           {
             //the teacher isnt in database
             var_dump($db->error());
             return 3;
           }
     }
     else
      {
        //the subject isnt in databse
        return 4;
      }
  }

    public function insertStudent($userId, $name, $fName, $email, $pass, $classes, $phone, $img){
        $userDb = $this->userdb($userId);
        $database = $this->connect();

        $classId = $userDb->select("classes", "*", [
          'class' => $classes
        ]);

        $setUser = $userDb->insert("students", [
          'name' => $name,
          'fName' => $fName,
          'email' => $email,
          'pass' => $pass,
          'class' => $classId[0]["id"],
          'phone' => $phone,
          'img' => $img
        ]);
        if ($setUser) {

          return 1;
        }

        $emailExist = $this->emailExists($email);
        $phoneExist = $this->phoneExists($phone);

        if ($emailExist && $phoneExist) {
          return 3;
        }
        else if($emailExist){
          return 4;
        }
        else if($phoneExist){
          return 5;
        }
      }

    public function getStudents($userId){
          $userDb = $this->userdb($userId);
          return $userDb->select("students", "*");
      }

      public function setResults($userId, $result, $subject, $sdInformation, $date){
            $userDb = $this->userdb($userId);
            $getSubject = $userDb->select("subjects", "*", [
              'subject' => $subject
            ]);

            if(count($getSubject) > 0)
            {
                $setResult=  $userDb->insert("results", [
                  'teacher_Id' => $userId,
                  'student_id' => $sdInformation,
                  'subject' => $getSubject[0]["id"],
                  'result' => $result,
                  'date' => $date
                ]);

                if ($setResult)
                {
                  return 1;
                }
                else
                {
                  return 0;
                }
        }else {
          return 5;
        }

    }

    public function setSubject($userId, $subject)
    {
      $userDb = $this->userdb($userId);

      $getSubject = $userDb->select("subjects", "*", [
        'subject' => $subject,
      ]);

      if (count($getSubject )== 0)
      {
          $setSubject= $userDb->insert("subjects", [
            "subject" => $subject,
          ]);


          if ($setSubject)
          {
            return 1;
          }
      }
      else
      {
          return 3;
      }
    }
    public function getAllSubjects() {
      $userdb = $this->userdb($_SESSION['id']);
      $subjects = $userdb->select("subjects", "*");
      return $subjects;
    }

    public function getAllClasses() {
      $userdb = $this->userdb($_SESSION['id']);
      $classes = $userdb->select("classes", "*");
      return $classes;
    }

    public function getStudentsFromClass($classid) {
      $userdb = $this->userdb($_SESSION['id']);
      $students = $userdb->select("students", "*"/*, [
        'class' => $classid
      ]*/);
      return $students;
    }

  public function deleteTeachers($userId, $students, $email)
  {
      $database = $this->connect();
      $userDb = $this->userdb($userId);

      $teach = $userDb->select("teacher", "*",[
        'id' => $students
      ]);

      if ($teach[0]["classTeacher"] == "Yes")
      {
          echo 1;

      }
      else
      {
          $deleteTeacher = $database->delete("users", [
            'email' => $email
          ]);
          $delete = $userDb->delete("teacher" ,[
            'id' => $students
          ]);

          echo 0;
    }

  }

  public function setAbsence($userId, $absence, $subject, $sdInformation, $date){
        $userDb = $this->userdb($userId);
        $getSubject = $userDb->select("subjects", "*", [
          'subject' => $subject
        ]);

        if(count($getSubject) > 0)
        {

            $setAbsence = $userDb->insert("absence", [
              'teacher_id' => $userId,
              'student_id' => $sdInformation,
              'subject' => $getSubject[0]["id"],
              'absence' => $absence,
              'date' => $date

            ]);

            if ($setAbsence)
            {
              //work
              return 1;
            }
            else
            {
              //dont work
              return 0;
            }
    }else {
      return 5;
    }
  }

  public function getAbsence($userId){
        $userDb = $this->userdb($userId);

        $absence = array();
        for ($i=9; $i <= 12 ; $i++)
        {
              $sum = array();
              $period = array();

              for ($k=0; $k <=30 ; $k++)
              {
                  $absences = $userDb->select("absence", "*", [
                    'date' => date("Y-m-d", mktime(0, 0, 0, $i, $k, 2017))
                  ]);

                  if (count($absences) != 0)
                  {
                      for ($j=0; $j < count($absences); $j++)
                      {
                        array_push($sum, $absences[$j]["absence"]);
                      }
                  }
              }


              if (count($sum) != 0)
              {
                  $period[0] = $i;
                  $period[1] = array_sum($sum);
                  array_push($absence, $period);
              }
              else
              {
                  $period[0] = $i;
                  $period[1] = 0;
                  array_push($absence, $period);
              }

              unset($period);
              unset($sum);
        }

        for ($i=1; $i <= 6 ; $i++) {
            $sum = array();
            $period = array();

            for ($k=0; $k <=30 ; $k++)
            {

                $absences = $userDb->select("absence", "*", [
                  'date' => date("Y-m-d", mktime(0, 0, 0, $i, $k, 2018))
                ]);

                if (count($absences) != 0)
                {
                  for ($j=0; $j < count($absences); $j++)
                  {
                      array_push($sum, $absences[$j]["absence"]);
                  }
                }
            }



            if (count($sum) != 0)
             {
                $period[0] = $i;
                $period[1] = array_sum($sum);
                array_push($absence, $period);
            }
            else
            {
                $period[0] = $i;
                $period[1] = 0;
                array_push($absence, $period);
            }

            unset($period);
            unset($sum);
        }

        return $absence;
    }

    public function deleteAbsence($userId, $absence)
    {
            $userDb = $this->userdb($userId);

            $teach = $userDb->select("absence", "*",[
              'id' => $absence
            ]);

            $delete = $userDb->delete("absence" ,[
              'id' => $absence
            ]);

            return 1;


    }

    public function deleteResults($userId, $resutultsId)
    {
      $userDb = $this->userdb($userId);
      $delete = $userDb->delete("results" ,[
        'id' => $resutultsId
      ]);

    }
    public function deleteClasses($userId, $class)
    {
      $database = $this->connect();
      $userDb = $this->userdb($userId);
      $delete = $userDb->delete("classes" ,[
        'id' => $class
      ]);

      $getEmail = $database->select("users", "*", [
        "id" => $userId
      ]);
      $updateClassTeacher = $userDb->update("teacher", ["classTeacher" => "No"],["email" => $getEmail[0]["email"]] );

    }

    public function deleteStudents($userId, $student)
    {


        $userDb = $this->userdb($userId);

        echo $student  ;

        $deleteFromStudents = $userDb->delete("students" ,[
          'id' => $student
        ]);

        $deleteFromResults = $userDb->delete("results" ,[
          'student_id' => $student
        ]);

        $deleteFromAbsence = $userDb->delete("absence" ,[
          'student_id' => $student
        ]);
        var_dump($userDb->error());
    }

    public function deleteSubject($userId, $subject)
    {
      $userDb = $this->userdb($userId);
      $deleteFromStudents = $userDb->delete("subjects" ,[
        'id' => $subject
      ]);

    }

    public function getResults($userId){
      $userDb = $this->userdb($userId);

      $getResults = $userDb->select("results", "*");
      $resultsCount = count($getResults);

      return $resultsCount;
    }

    public function getAllAbsence($userId){
      $userDb = $this->userdb($userId);

      $getAbsences = $userDb->select("absence", "*");

      $absencesCount = count($getAbsences);

      return $absencesCount;
    }

    public function getAbsenceSum($userId){
      $userDb = $this->userdb($userId);

      $getSum = $userDb->sum("absence", "absence");

      return $getSum;
    }

    public function getResultsAverage($userId){
      $userDb = $this->userdb($userId);

      $getAverage = $userDb->avg("results", "result");

      return $getAverage;
    }

}
