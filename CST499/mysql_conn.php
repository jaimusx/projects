<?php

	error_reporting(E_ALL ^ E_NOTICE);

	class dbActions {

		public static function checkResults($query) {
			if($query) {
				return true;
			} else {
				return false;
			}
		}

		public static function executeQuery($con, $sql) {
			
			# Check if the entry box fields has data
			if(isset($_POST['email']) && isset($_POST['pwd']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['phone'])) {

				# Run the query
				$query = mysqli_query($con, $sql);

				# Display results in the url.
				if (dbActions::checkResults($query) == true) {
					exit(header("Location: ../CST499/index.php?register=sucess"));
				} else {
					exit(header("Location: ../CST499/index.php?register=failed"));
				}
			}
		}

		public static function executeSelectQuery($con, $sql) {

			# Check if the email and password variables in the text box are present.
			if(isset($_POST['email']) && isset($_POST['pwd'])) {

				# Run the query
				$query = mysqli_query($con, $sql);

				# Verify that the connection to the database was established.
				if (dbActions::checkResults($query) == true) {

					# Get all row data for the user if correct
					$row = mysqli_fetch_assoc($query);

					if ($row == null) {
						# Display error.
						session_start();
						$_SESSION['login'] = false;
						exit(header("Location: ../CST499/login.php?login=failed"));
					}
					else if ($row['email'] == $_POST['email'] && $row['pwd'] == $_POST['pwd']) {

						# Begin an new session and inject the user's first name into the 'username' variable.
						session_start();
						# Returns to the home screen and removes the login and registration buttons.
						$_SESSION['username'] = $row['firstName'];
						$_SESSION['lastname'] = $row['lastName'];
						$_SESSION['email'] = $row['email'];
						$_SESSION['pwd'] = $row['pwd'];
						$_SESSION['address'] = $row['address'];
						$_SESSION['phone'] = $row['phone'];
						$_SESSION['login'] = true;

						exit(header("Location: ../CST499/student_page.php?login=success"));
					}
				}
			} else {
				exit(header("Location: ../CST499/login.php?login=failed"));
			}
		}
	}

$con = mysqli_connect('localhost', 'root', '', 'cst499_website') or die("Connection Could Not Be Established" .mysqli_connect_error());

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
		include_once 'registration.php';

		# Set variables
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];
		$pwd_conf = $_POST['pwd-confirm'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];

		if($pwd !== $pwd_conf) {
			session_start();
			#$_SESSION['pwd'] = false;
			#$_SESSION['pwd-confirm'] = false;
			exit(header("Location: ../CST499/registration.php?error=password"));
		} else {
			$sql = "INSERT INTO `tbluser` (`email`, `pwd`, `firstName`, `lastName`, `address`, `phone`) VALUES ('$email', '$pwd', '$fname', '$lname', '$address', '$phone');";
			dbActions::executeQuery($con, $sql);
		}

	} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
		include_once 'login.php';

		# Set variables
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];

		$sql = "SELECT * FROM tbluser WHERE email='$email' AND pwd='$pwd';";

		dbActions::executeSelectQuery($con, $sql);
	} else {
		header("Location: ../CST499/index.php?index=error");
		exit;
	}
