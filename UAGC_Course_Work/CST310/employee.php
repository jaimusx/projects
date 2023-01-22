<?php
    error_reporting(E_ALL ^ E_NOTICE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> Profile Page </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style type="text/css">
    label {
      width: 250px;
      display: inline-block;
	    text-align: left;
	    margin: 50px;
    }
  </style>
</head>
<body>
<?php include 'master.php';?>

  <div class="container text-center">
    <h3>Employee Connection</h3><br>
  </div>


  <div class="container">
    <div class="container text-center">
      <div class="jumbotron">
        <div class="row">
          <div class="col-sm-4">
            <h3><span class="glyphicon glyphicon-asterisk"></span> What's New?</h3>
            <p>Fall decorations are making a return on your floor!</p>
            <p>We are look forward to seeing what new creations the IT department has for us this year!</p>
          </div>
          <div class="col-sm-4">
            <h3><span class="glyphicon glyphicon-star"></span> Topics Of The Week</h3>
            <p>401K. If you have questions, we can help!</p>
            <p>Does my vacation time roll over? Here are all the answers you need.</p>
          </div>
          <div class="col-sm-4">
            <h3><a href="#"><span class="glyphicon glyphicon-cog"></span> My Settings</a></h3>
            <p>Cick here to access your personal settings.</p>
            <p>You can change your theme, edit your information, and contact HR for help.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include 'footer.php';?>
</body>
</html>
