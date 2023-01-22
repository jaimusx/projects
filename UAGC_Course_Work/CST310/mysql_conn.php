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
			if(isset($_POST['email']) && isset($_POST['pwd']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['phone']) && isset($_POST['salary']) && isset($_POST['ssn'])) {

				# Run the query
				$query = mysqli_query($con, $sql);

				# Display results in the url.
				if (dbActions::checkResults($query) == true) {
					header("Location: ../Website/registration.php?register=sucess");
					exit();
				} else {
					header("Location: ../Website/registration.php?register=failed");
					exit();
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
						echo '<div class="container text-center">
							    <h4>Your email or password is incorrect! Please try again.</h4>
							  </div>';
						exit();
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
						$_SESSION['salary'] = $row['salary'];
						$_SESSION['ssn'] = $row['SSN'];

						header("Location: ../Website/index.php?login=success");
						exit();
					}
				}
			} else {
				header("Location: ../Website/login.php?login=failed");
				exit();
			}
		}
	}

	$con = mysqli_connect('localhost', 'root', '', 'cst310_website') or die("Connection Could Not Be Established" .mysqli_connection_error());

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
		include_once 'registration.php';

		# Set variables
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$salary = $_POST['salary'];
		$ssn = $_POST['ssn'];

		$sql = "INSERT INTO `tbluser` (`email`, `pwd`, `firstName`, `lastName`, `address`, `phone`, `salary`, `SSN` ) VALUES ('$email', '$pwd', '$fname', '$lname', '$address', '$phone', '$salary', '$ssn');";

		dbActions::executeQuery($con, $sql);

	} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
		include_once 'login.php';

		# Set variables
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];

		$sql = "SELECT * FROM tbluser WHERE email='$email' AND pwd='$pwd';";

		dbActions::executeSelectQuery($con, $sql);
	} else {
		header("Location: ../Website/index.php?index=error");
		exit();
	}
