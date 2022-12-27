<?php
  include_once 'master.php';  
?>
<head>
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
    <p>ABC University provides 24 hour services for students that need help with thier online needs.<br><br>
    We can be reached at:<br><br>Web Support: 555-159-9547<br>Registrar: 555-159-9548<br>
    Student Finance: 555-159-9549<br><br>
    Our head office is located at:<br><br>1234 Dokin Street<br>Any Town, USA 00001-0000</p>
  </div>
</div>
</body>
</html>
<?php
  include_once 'footer.php';
?>