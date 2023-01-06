<?php
  include_once 'master.php';  
?>
<head>
  <title>About Us</title>
  <style>
    h1 {
      color: #444;
      font-size: 50px;
    }
    label {
      width: 200px;
      display: inline-block;
	    text-align: left;
      padding: 5px;
    }
	  input {
	    width: 225px;
      display: inline-block;
      padding: 5px;
	  }
    input[type="submit"] {
      background-color: rgb(117, 38, 59);
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      padding: 12px;
      margin: 15px;
      font-size: 18px;
    }
    input[type="submit"]:hover {
      background-color: rgb(105, 38, 59);
    }
  </style>
</head>
<body>
<div class="reg-container">
  <div class="form-reg-container">
    <h1>About US</h1>
    <p>ABC University has been providing higher learning experiences since 1981.<br><br>
    We are dedicated to providing the education that students are looking for and to help 
    them grow in their careers.<br><br>
    Our mission is to ensure the best opportunity in a growing job market and to prepare our students for the future</p>
  </div>
</div>
</body>
</html>
<?php
  include_once 'footer.php';
?>