<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>CHARUSAT CLUBS PORTAL</title>
    <link rel="stylesheet" href="style.css"/>
    <style>
      .dropdown{
  width:225px;
  height:50px;
  padding:0px 0px 0px 15px;
}
    </style>
</head>
<body>
<?php
    require('db.php');
    session_start();
    error_reporting(0);
    // When form submitted, check and create user session.
    if (isset($_POST['username']) || isset($_POST['clubs'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $module = stripslashes($_REQUEST['module']);
        $module = mysqli_real_escape_string($con, $module);
        $clubs = stripslashes($_REQUEST['clubs']);
        $clubs = mysqli_real_escape_string($con, $clubs);
        
        // Check user is exist in the database
        if($module =="student")
        {
        $query    = "SELECT 'username,module,password' FROM `student` WHERE username='$username'AND password='$password'AND module='$module'";
        $result = mysqli_query($con, $query);
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect to user dashboard page
            header("Location: ../studentdashboard.php");
            
        } else {
               echo "<script type='text/javascript'>alert('Invalid Credentials ! Please try again.');
            window.location.assign('index.php')</script>";
        }}
        else 
        
        if($module=="clubmanager")
        {
        $query    = "SELECT 'username,module,password,clubs' FROM `student` WHERE username='$username'AND password='$password'AND module='$module' AND clubs='$clubs'";
        $result = mysqli_query($con, $query);
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            // Redirect to user dashboard page
            if($clubs == "environment"){
            header("Location: ../clubs/clubmanager1.php");
            }
            if($clubs == "esports"){
              header("Location: ../clubses/clubmanager2.php");
            }
        } else {
              echo "<script type='text/javascript'>alert('Invalid Credentials ! Please try again.');
            window.location.assign('index.php')</script>";
        }}
    } else {
?>
      <div class="wrapper">
  <div class="title-text">
    <div class="title login">Login </div>
  </div>
    <div class="form-inner">
      <form class="form" method="post" class="login">
        <div class="field">
          <input type="text" placeholder="Username" name="username" required>
          </div>
          <div class="field">
          <input type="password" placeholder="Password" name="password" required>
        </div>
        <div class="field">
          <select name="module" id="module" >
               <option value="student" >Student</option>
               <option value="clubmanager">Club Manager</option>
             </select>
             <select name="clubs" id="clubs" >
             <option value=" " > </option> 
               <option value="environment" >Environment Club</option>
               <option value="esports">Esports Club</option>
             </select>
        </div>
       
         
        <div class="field btn">
          <div class="btn-layer"></div>
          <input type="submit" value="Login" name="submit">
        </div>
        <div class="signup-link">Not a member? <a href="registration.php">Signup now</a></div>
      </form>  
    </div>
<?php
    }
?>
</body>
</html>
