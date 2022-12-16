<?php
  use Medoo\Medoo;

  class AverageResults
  {


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

      public function getClasses($userId)
      {
        $userDb = $this->userdb($userId);

        return $classes = $userDb->select("classes", "*");
      }

      public function getStudents($userId)
      {

        $classesResults = array();

        $userDb = $this->userdb($userId);
        $classes = $this->getClasses($userId);

        for ($i=0; $i < count($classes) ; $i++)
        {
              $studentstResults = array();
              $classAverageResults =array();

              $students = $userDb->select("students", "*", [
                'class' => $classes[$i]["id"]
              ]);

              for ($j=0; $j <count($students) ; $j++)
              {
                $averageReasult = $userDb->avg("results", "result", [
                  "student_id" => $students[$j]["id"]
                ]);

                array_push($studentstResults, $averageReasult);
              }

            if (count($studentstResults) != 0) {
              $class = $classes[$i]["class"];
              $classAverageResults[0] = $class;
              

              $classAverageResults[1] = number_format(array_sum($studentstResults) / count($studentstResults), 2, '.', '');
              array_push($classesResults, $classAverageResults);
            }

            unset($classAverageResults);
            unset($studentstResults);
        }
        $data = $this->bubblesort($classesResults);
        return $data;
      }

      function swappositions($data, $left, $right) {
          $backup_old_data_right_value = $data[$right];
          $data[$right] = $data[$left];
          $data[$left] = $backup_old_data_right_value;
          return $data;
      }

      function bubblesort($data) {
        $data_length = count($data[1]);
        for ($i=0; $i<count($data[1]); $i++) {
            for ($j=0; $j<count($data[1])-1-$i; $j++) {
                if ($data[1][$j+1] < $data[1][$j]) {
                        $data[1] = $this->swappositions($data[1], $j, $j+1);
                        $data[0] = $this->swappositions($data[0], $j, $j+1);
                }
            }
          }
        return $data;
      }


  }
