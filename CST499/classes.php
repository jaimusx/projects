<?php

class dbConnect {

    public static function mysqlConn() {
      
      $host = 'localhost';
      $username = 'root';
      $password = '';
      $database = 'cst499_website';

      $con = mysqli_connect($host, $username, $password, $database) or die("Connection Could Not Be Established" . mysqli_connect_error());

      return $con;
  }
}

class dbQuery {
  # Check if the MySQL query has returned values
  public static function checkResults($query) {
    if ($query) {
      return true;
    } else {
      return false;
    }
  }
}

class studentRegister {
  public static function executeRegistration($sql) {

    $con = dbConnect::mysqlConn();

    # Check if the entry box fields has data.
    if (isset($_POST['email']) && isset($_POST['pwd']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['phone'])) {

      # Run the query
      $query = mysqli_query($con, $sql);

      # Display results in the url.
      if (dbQuery::checkResults($query) == true) {
        exit(header("Location: ../CST499/registration.php?register=success"));
      } else {
        exit(header("Location: ../CST499/registration.php?register=failed"));
      }
    } else {
      exit(header("Location: ../CST499/registration.php?register=error"));
    }
  }

  public static function pwdMatch($pwd, $pwd_conf) {
    # Check if password and verify password entries match.
    if ($pwd === $pwd_conf) {
      return true;
    } else {
      return false;
    }
  }

  public static function validEmail($email) {
    # Check if the email submitted is a valid type.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return false;
    } else {
      return true;
    }
  }  

  public static function checkEmailExists($email) {
    
    $con = dbConnect::mysqlConn();
    
    # Check if the email is already registered.
    $sql = "SELECT * FROM tblstudent WHERE email =?;";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      exit(header("Location: ../CST499/registration.php?stmtfailed"));
    } 
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $results = mysqli_stmt_get_result($stmt);

    if (mysqli_fetch_assoc($results)) {
      mysqli_stmt_close($stmt);
      return true;
    } else {
      mysqli_stmt_close($stmt);
      return false;
    }
  }

  public static function setRegistration() {
    
    $con = dbConnect::mysqlConn();

    # Check if 'Register' button has been pressed and all entry boxes are filled.
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
      include_once 'registration.php';
      
      # Set variables
      $email = $_POST['email'];
      $pwd = $_POST['pwd'];
      $pwd_conf = $_POST['pwd-confirm'];
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $address = $_POST['address'];
      $phone = $_POST['phone'];

      if (studentRegister::pwdMatch($pwd, $pwd_conf) === false) {
        exit(header("Location: ../CST499/registration.php?error=passwordmatcherror"));
      }

      if (studentRegister::validEmail($email) === false) {
        exit(header("Location: ../CST499/registration.php?error=invalidemail"));
      }

      if (studentRegister::checkEmailExists($email) === true) {
        exit(header("Location: ../CST499/registration.php?error=userexists"));
      }

      $sql = "INSERT INTO tblstudent (email, pwd, firstName, lastName, address, phone) VALUES ('$email', '$pwd', '$fname', '$lname', '$address', '$phone');";
      studentRegister::executeRegistration($sql);
    } else {
      exit(header("Location: ../CST499/registration.php?error=badmethod"));
    }
  }
}

class studentLogin {
  public static function executeLogin($sql) {

    $con = dbConnect::mysqlConn();

    # Check if the email and password variables in the text box are present.
    if (isset($_POST['email']) && isset($_POST['pwd'])) {

      # Run the query
      $query = mysqli_query($con, $sql);

      # Verify that the connection to the database was established.
      if (dbQuery::checkResults($query) == true) {

        # Get all row data for the user if correct
        $row = mysqli_fetch_assoc($query);

        if ($row == null) {
          # Display login error.
          exit(header("Location: ../CST499/login.php?login=failed"));
        } else if ($row['email'] == $_POST['email'] && $row['pwd'] == $_POST['pwd']) {

          # Returns to the home screen and removes the login and registration buttons.
          session_start();
          $_SESSION['student_id'] = $row['id'];
          $_SESSION['username'] = $row['firstName'];
          $_SESSION['lastname'] = $row['lastName'];
          $_SESSION['email'] = $row['email'];
          $_SESSION['pwd'] = $row['pwd'];
          $_SESSION['address'] = $row['address'];
          $_SESSION['phone'] = $row['phone'];
          $_SESSION['login'] = true;

          exit(header("Location: ../CST499/student_page.php?login=success"));
        } else {
          exit(header("Location: ../CST499/login.php?login=error"));
        }
      }
    } else {
      exit(header("Location: ../CST499/login.php?login=error"));
    }
  }

  public static function setLogin() {    
    # Check if 'Login' button has been pressed and all entry boxes are filled.
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
      include_once 'login.php';

      # Set variables
      $email = $_POST['email'];
      $pwd = $_POST['pwd'];

      $sql = "SELECT * FROM tblstudent WHERE email='$email' AND pwd='$pwd';";

      studentLogin::executeLogin($sql);
    } else {
      exit(header("Location: ../CST499/index.php?index=error"));
    }
  }
}

class courseRegister {

  public static function getEducationalData($identifier, $sql) {

    $con = dbConnect::mysqlConn();

    # Run the query
    $query = mysqli_query($con, $sql);

    # Check if query returned anything.
    if (dbQuery::checkResults($query) == true) {

      $data = "";

      if ($identifier === "semesters") {
        # Get all semester collumn data.
        while ($row = mysqli_fetch_assoc($query)) {
          $data .=  '<option value="' . $row['id'] . '">' . $row['semester'] . '</option>';
        } 
      } else if ($identifier === "courses") {
          # Get all semester collumn data.
          while ($row = mysqli_fetch_assoc($query)) {
            $data .=  '<option value="' . $row['id'] . '">' . $row['course'] . '</option>';
          }
      }

      return $data;

    } else {
      exit(header("Location: ../CST499/course_registration.php?error=db-error"));
    }
  }

  public static function getCourses() {

    # Set variables for the sql query.
    session_start();
    $first_name = $_SESSION['username'];
    $last_name = $_SESSION['lastname'];
    $student_id = $_SESSION['student_id'];
    $data = "";

    $con = dbConnect::mysqlConn();

    $sql = "SELECT * FROM tblenrollment WHERE firstName = '$first_name' && lastName = '$last_name' && studentID = '$student_id';";

    # Run the query.
    $query = mysqli_query($con, $sql);

    if (dbQuery::checkResults($query) == true) {

      while ($row = mysqli_fetch_assoc($query)) {
        $data .= '<tr style="background-color: rgb(117, 38, 59); color: white; font-size: 18px;">';
        $data .= '<td> Record Number </td>';
        $data .= '<td> Semester </td>';
        $data .= '<td> Course Name </td>';
        $data .= '<td> Delete Course </td>';
        $data .= '</tr>';
        $data .= '<tr>';
        $data .= '<td>' . $row['record'] . '</td>';
        $data .= '<td>' . $row['course'] . '</td>';
        $data .= '<td>' . $row['semester'] . '</td>';
        $data .= '<td><a href="my_courses.php?record=' . $row['record'] . '&course-name=' . $row['course'] . '&semester-id=' . $row['semester_id'] . '"class="btn btn-danger">Delete</a></td>';
        $data .= '</tr>';
      }

      return $data;

    } else {
      exit(header("Location: ../CST499/my_courses.php?error=db-error"));
    }
  }

  public static function removeCourse($record, $course_name, $semesterID) {

    $con = dbConnect::mysqlConn();

    $sql = "DELETE FROM tblenrollment WHERE record = '$record';
            SELECT * FROM tblcourses WHERE course = '$course_name' && semester_id = '$semesterID';
            UPDATE tblcourses SET availability = availability + 1
            WHERE course = '$course_name' && semester_id = '$semesterID' && availability < 30;";

    # Run the query
    $query = mysqli_multi_query($con, $sql);

    # Check if query returned anything.
    if (dbQuery::checkResults($query) == true) {
      exit(header("Location: ../CST499/my_courses.php?course-delete=success"));
    } else {
      exit(header("Location: ../CST499/my_courses.php?error=db-error"));
    }
  }

  public static function registerCourse($semesterID, $courseID) {

    # Set global variables.
    $availablity =  null;
    $semester_name = "";
    $semester_id = "";
    $course_name = "";
    $registered_course = "";

    # Set variables for student information to go into the next query.
    session_start();
    $first_name = $_SESSION['username'];
    $last_name = $_SESSION['lastname'];
    $student_id = $_SESSION['student_id'];

    $con = dbConnect::mysqlConn();

    # First query to get the course information.
    $sql1 = "SELECT tblcourses.*, tblsemesters.semester FROM tblcourses
             INNER JOIN tblsemesters ON tblcourses.semester_id = tblsemesters.id 
             WHERE tblcourses.semester_id = '$semesterID' && tblcourses.id = '$courseID';";

    # Run the first query.
    $query1 = mysqli_query($con, $sql1);

    # Check if query returned anything.
    if (dbQuery::checkResults($query1) == true) {
      
      $row = mysqli_fetch_assoc($query1);

      if ($row == null) {
        # Display login error.
        exit(header("Location: ../CST499/course_registration.php?error=no-data"));
      } else {
        $availablity = $row['availability'];
        $course_name = $row['course'];
        $semester_name = $row['semester'];
        $semester_id = $row['semester_id'];
      }
    
    # Second query to check if the student is already registerd to the selected course.
    $sql2 = "SELECT * FROM tblenrollment WHERE course = '$course_name' && firstName = '$first_name' && lastName = '$last_name' && studentID = '$student_id';";

    # Run the second query.
    $query2 = mysqli_query($con, $sql2);

    # Check if query returned anything.
    if (dbQuery::checkResults($query2) == true) {

      $row = mysqli_fetch_assoc($query2);

      if ($row == null) {
        $registered_course = null;
      } else {
        $registered_course = $row['course'];
      }
    }

    # Verify that the student is not already register to the course.
    if ($registered_course === $course_name) {
      exit(header("Location: ../CST499/course_registration.php?enrolled=1"));
    }

    # Verify that there is a spot available for the course.
    if ($availablity === "0") {
      exit(header("Location: ../CST499/course_registration.php?error=no-availability"));
    } else {

      # Register the student for the course selected to the tblenrollment table.
      $sql3 = 
      "INSERT INTO tblenrollment (firstName, lastName, course, semester, semester_id, studentID) VALUES 
          ('$first_name', '$last_name', '$course_name', '$semester_name', '$semester_id', '$student_id');
      SELECT * FROM tblcourses WHERE semester_id = '$semesterID' && id = '$courseID';
      UPDATE tblcourses SET availability = availability - 1 WHERE id = '$courseID' && availability > 0 ;
      ";
      
      # Run new multiquery to add student and decrement the total availability.
      $query3 = mysqli_multi_query($con, $sql3);

      # Verify the new query.
      if (dbQuery::checkResults($query3) == true) {
        # Retrun back to the course register page and display a successful message.
        exit(header("Location: ../CST499/course_registration.php?course-register=success"));
      } else {
        # Return an error warning on the course register page.
        exit(header("Location: ../CST499/course_registration.php?error=db-error"));
      }
    }
    } else {
      header("Location: ../CST499/course_registration.php?error=db-error");
      exit;
    }
  }
}