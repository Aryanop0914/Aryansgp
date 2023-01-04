<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Homestay</title>
    <link rel="stylesheet" href="css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
  <?php
    require('Backend/Users/db.php');
    session_start();
    error_reporting(0);
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $module = stripslashes($_REQUEST['module']);
        $module = mysqli_real_escape_string($con, $module);


        
        // Check user is exist in the database
        if($module =="hii")
        {
        $query = "SELECT 'username,password' FROM `accounts` WHERE username='$username'AND password='$password'";
        $result = mysqli_query($con, $query);
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect to user dashboard page
            header("Location: index.php");
            
        } else {
               echo "<script type='text/javascript'>alert('Invalid Credentials ! Please try again.');
            window.location.assign('index.php')</script>";
        }}
    } else {
?>
    <div class="wrapper">
      <div class="title-text">
        <div class="title login">Login Form</div>
        <div class="title signup">Signup Form</div>
      </div>
      <div class="form-container">
        <div class="slide-controls">
          <input type="radio" name="slide" id="login" checked>
          <input type="radio" name="slide" id="signup">
          <label for="login" class="slide login">Login</label>
          <label for="signup" class="slide signup">Signup</label>
          <div class="slider-tab"></div>
        </div>
        <div class="form-inner">
          <form action="post" class="login">
            <div class="field">
              <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="field">
              <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="pass-link"><a href="#">Forgot password?</a></div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" value="Login">
            </div>
            <div class="signup-link">Not a member? <a href="">Signup now</a></div>
          </form>
          <?php
    }
?>

<?php
          require('Backend/Users/db.php');
          // When form submitted, insert values into the database.
          if (isset($_REQUEST['username'])) {
              // removes backslashes
              $username = stripslashes($_REQUEST['username']);
              //escapes special characters in a string
              $username = mysqli_real_escape_string($con, $username);
              $email = stripslashes($_REQUEST['email']);
              $email = mysqli_real_escape_string($con, $email);
              $password = stripslashes($_REQUEST['password']);
              $password = mysqli_real_escape_string($con, $password);
              $module = "hii";
              $module = mysqli_real_escape_string($con, $module);
              
              $createdate = date("d-m-y");
             
              $query    = "INSERT into `accounts` (username, email, password, module, createdate)
                           VALUES ('$username','$email','$password','$module','$createdate')";
              $result   = mysqli_query($con, $query);
              if ($result) {
                  echo "<div class='form'>
                        <h3>Account Created successfully.</h3><br/>
                        <p class='link'>Click here to go on <a href='login.php'>login page</a> again.</p>
                        </div>";
                  
      
              } else {
                  echo "<div class='form'>
                        <h3>Required fields are missing.</h3><br/>
                        <p class='link'>Click here to <a href='login.php'>create account</a> again.</p>
                        </div>";
              }
          
        } else {
      ?>

          <form method="post" class="signup">
            <div class="field">
              <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="field">
              <input type="text" placeholder="Email Address" name="email" required>
            </div>
            <div class="field">
              <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="field">
              <input type="password" placeholder="Confirm password" name="cpassword">
            </div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" value="Signup">
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
      const loginText = document.querySelector(".title-text .login");
      const loginForm = document.querySelector("form.login");
      const loginBtn = document.querySelector("label.login");
      const signupBtn = document.querySelector("label.signup");
      const signupLink = document.querySelector("form .signup-link a");
      signupBtn.onclick = (()=>{
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
      });
      loginBtn.onclick = (()=>{
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
      });
      signupLink.onclick = (()=>{
        signupBtn.click();
        return false;
      });
    </script>
<?php
    }
?>
  </body>
</html>
