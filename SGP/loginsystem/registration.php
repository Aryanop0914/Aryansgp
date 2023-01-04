<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>CHARUSAT CLUBS PORTAL</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $module    = "student";
        $module    = mysqli_real_escape_string($con, $module);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $clubs= " ";
        $clubs    = mysqli_real_escape_string($con, $clubs);
        $createdate = date("d-m-Y ");
       
        $query    = "INSERT into `student` (username, password, module, clubs, createdate)
                     VALUES ('$username', '$password', '$module', '$clubs','$createdate')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>New Student is registered successfully.</h3><br/>
                  <p class='link'>Click here to go on <a href='login.php'>login page</a> again.</p>
                  </div>";
            

        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    
  }
    else {
      ?>
    
    <div class="wrapper">
  <div class="title-text">
  <div class="title signup">Signup </div>
  </div>
    <div class="form-inner">
      <form class="form" method="post" class="login">
      <div class="field">
          <input type="text" placeholder="Username" name="username" required>
        </div>
        <div class="field">
          <input type="text" placeholder="Email Address" name="email" required>
        </div>
        <div class="field">
          <input type="password" placeholder="Password" name="password" required>
        </div>
        <div class="field btn">
          <div class="btn-layer"></div>
          <input type="submit" value="Signup">
        </div>
        <center>
          <br><a href="login.php">Log in now</a></div>
    </center>
      </form>  
    </div>
<?php
    }
?>
</body>
</html>
