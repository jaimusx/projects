<?php

# Prevent access to this file from a url request.
if(!isset($_SERVER['HTTP_REFERER'])){
  // redirect them to your desired location
  exit(header('Location: ../CST499/index'));
}

class dbConnect {

    public static function mysqlConn() {
      
      $host = 'localhost';
      $username = 'root';
      $password = '';
      $database = 'cst499_website';

      $con = mysqli_connect($host, $username, $password, $database) or die("Connection Could Not Be Established" . mysqli_connect_error());

      return $con;
  }

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
      if (dbConnect::checkResults($query) == true) {
        exit(header("Location: ../CST499/registration?register=success"));
      } else {
        exit(header("Location: ../CST499/registration?register=failed"));
      }
    } else {
      exit(header("Location: ../CST499/registration?register=error"));
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
      exit(header("Location: ../CST499/registration?stmtfailed"));
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
        exit(header("Location: ../CST499/registration?error=passwordmatcherror"));
      }

      if (studentRegister::validEmail($email) === false) {
        exit(header("Location: ../CST499/registration?error=invalidemail"));
      }

      if (studentRegister::checkEmailExists($email) === true) {
        exit(header("Location: ../CST499/registration?error=userexists"));
      }

      $sql = "INSERT INTO tblstudent (email, pwd, firstName, lastName, address, phone) VALUES ('$email', '$pwd', '$fname', '$lname', '$address', '$phone');";
      studentRegister::executeRegistration($sql);
    } else {
      exit(header("Location: ../CST499/registration?error=badmethod"));
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
      if (dbConnect::checkResults($query) == true) {

        # Get all row data for the user if correct
        $row = mysqli_fetch_assoc($query);

        if ($row == null) {
          # Display login error.
          exit(header("Location: ../CST499/login?login=failed"));
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
          $_SESSION['logged_in'] = true;

          exit(header("Location: ../CST499/student_page?login=success"));
        } else {
          exit(header("Location: ../CST499/login?login=error"));
        }
      }
    } else {
      exit(header("Location: ../CST499/login?login=error"));
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
      exit(header("Location: ../CST499/index?index=error"));
    }
  }
}

class courseRegister
{

  public static function getEducationalData($identifier, $sql)
  {

    $con = dbConnect::mysqlConn();

    # Run the query
    $query = mysqli_query($con, $sql);

    # Check if query returned anything.
    if (dbConnect::checkResults($query) == true) {

      $data = "";

      if ($identifier === "semesters") {
        # Get all semester collumn data.
        while ($row = mysqli_fetch_assoc($query)) {
          $data .= '<option value="' . $row['id'] . '">' . $row['semester'] . '</option>';
        }
      } else if ($identifier === "courses") {
        # Get all semester collumn data.
        while ($row = mysqli_fetch_assoc($query)) {
          $data .= '<option value="' . $row['id'] . '">' . $row['course'] . ' - Availability: ' . $row['availability'] . '</option>';
        }
      }

      return $data;

    } else {
      exit(header("Location: ../CST499/course_registration?error=db-error"));
    }
  }

  public static function getCourses()
  {

    # Set variables for the sql query.
    session_start();
    $first_name = $_SESSION['username'];
    $last_name = $_SESSION['lastname'];
    $student_id = $_SESSION['student_id'];

    $con = dbConnect::mysqlConn();

    $sql = "SELECT * FROM tblenrollment WHERE firstName = '$first_name' && lastName = '$last_name' && studentID = '$student_id';";

    # Run the query.
    $query = mysqli_query($con, $sql);

    # Verify the query returned a value and that the value is not empty.
    if (dbConnect::checkResults($query) == true && mysqli_num_rows($query) > 0) {

      # Populate table headers.
      $data = '<tr style="background-color: rgb(117, 38, 59); color: white; font-size: 18px;">
      <td> Record Number </td>
      <td> Semester </td>
      <td> Course Name </td>
      <td> Delete Course </td>
      </tr>';

      while ($row = mysqli_fetch_assoc($query)) {
        $data .= '<tr>';
        $data .= '<td>' . $row['record'] . '</td>';
        $data .= '<td>' . $row['course'] . '</td>';
        $data .= '<td>' . $row['semester'] . '</td>';
        $data .= '<td><a onClick="javascript:return confirm(\'Are you sure you want to delete this course?\')" href="my_courses?record=' . $row['record'] . '&course-name=' . $row['course'] . '&semester-id=' . $row['semester_id'] . '"class="btn btn-danger">Delete</a></td>';
      }

      $data .= '</tr>';
      return $data;

    }
  }

  public static function removeCourse($record, $course_name, $semesterID)
  {

    $con = dbConnect::mysqlConn();

    $sql = "DELETE FROM tblenrollment WHERE record = '$record';
            SELECT * FROM tblcourses WHERE course = '$course_name' && semester_id = '$semesterID';
            UPDATE tblcourses SET availability = availability + 1
            WHERE course = '$course_name' && semester_id = '$semesterID' && availability < 30;";

    # Run the query
    $query = mysqli_multi_query($con, $sql);

    # Check if query returned anything.
    if (dbConnect::checkResults($query) == true) {
      exit(header("Location: ../CST499/my_courses?course-delete=success"));
    } else {
      exit(header("Location: ../CST499/my_courses?error=db-error"));
    }
  }

  public static function registerCourse($semesterID, $courseID)
  {

    # Set variables.
    $availablity = null;
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
    if (dbConnect::checkResults($query1) == true) {

      $row = mysqli_fetch_assoc($query1);

      if ($row == null) {
        # Display login error.
        exit(header("Location: ../CST499/course_registration?error=no-data"));
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
      if (dbConnect::checkResults($query2) == true) {

        $row = mysqli_fetch_assoc($query2);

        if ($row == null) {
          $registered_course = null;
        } else {
          $registered_course = $row['course'];
        }
      }

      # Verify that the student is not already register to the course.
      if ($registered_course === $course_name) {
        exit(header("Location: ../CST499/course_registration?enrolled=1"));
      }

      # Verify that there is a spot available for the course.
      if ($availablity === "0") {
        session_start();
        $_SESSION['availability'] = $availablity;
        $_SESSION['course_name'] = $course_name;
        $_SESSION['semester_name'] = $semester_name;
        $_SESSION['semester_id'] = $semester_id;
        exit(header("Location: ../CST499/course_registration?availability=0"));
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
        if (dbConnect::checkResults($query3) == true) {
          # Retrun back to the course register page and display a successful message.
          exit(header("Location: ../CST499/course_registration?course-register=success"));
        } else {
          # Return an error warning on the course register page.
          exit(header("Location: ../CST499/course_registration?error=db-error"));
        }
      }
    } else {
      header("Location: ../CST499/course_registration?error=db-error");
      exit;
    }
  }

  public static function addToWaitlist() {

    $con = dbConnect::mysqlConn();

    session_start();
    $course_name = $_SESSION['course_name'];
    $semester_name = $_SESSION['semester_name'];
    $semester_id = $_SESSION['semester_id'];
    $student_id = $_SESSION['student_id'];
    $fname = $_SESSION['username'];
    $lname = $_SESSION['lastname'];
    $email = $_SESSION['email'];

    # Query to check if the student is already on the waiting list to the selected course.
    $sql = "SELECT * FROM tblwaitlist WHERE course = '$course_name' && semester = '$semester_name' && studentID = '$student_id';";

    # Run the query.
    $query = mysqli_query($con, $sql);

    # Check if query returned anything.
    if (dbConnect::checkResults($query) == true) {

      $row = mysqli_fetch_assoc($query);

      # If no information is return with the applied student data. Add them to the waiting list.
      if ($row == null) {
        
        $sql = "INSERT INTO tblwaitlist (firstName, lastName, course, semester, semester_id, studentID, email) VALUES 
               ('$fname', '$lname', '$course_name', '$semester_name', '$semester_id', '$student_id', '$email')";
        # Run the query
        $query = mysqli_multi_query($con, $sql);

        # Check if query returned anything.
        if (dbConnect::checkResults($query) == true) {
          exit(header("Location: ../CST499/course_registration?waitlistadd=success"));
        } else {
          exit(header("Location: ../CST499/course_registration?error=db-error"));
        }
      } else {
        exit(header("Location: ../CST499/course_registration?waitlistadd=1"));
      }
    }
  }
}