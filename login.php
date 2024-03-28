<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'Connection.php';

  if(isset($_POST['submit']))
  {
    $username = $_POST['uname'];
    $password = $_POST['password'];
    $error = array();
    if(empty($username) || empty($password))
      array_push($error, "*Empty fields present");
    if(count($error)==0) {
      $conn = new Connection();
      $result = $conn->checkUser($username);
      print_r($result);
      if(count($result)>0) {
        if($conn->checkPassword($password, $result[0]['userPassword'])) {
          session_start();
          $_SESSION['userName'] = $username;
          header('location: form.php');
        }
        else {
          array_push($error, "*Incorrect Password");
        }
      }
      else {
        array_push($error, "*User does not exist.");
      }
    }
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <style>
    <?php include './index.css';?>
  </style>
</head>
<body>
<div class="container">
    <h2>User Login</h2>
    <form action="login.php" method="post">
      <div class="form-input">
        <input class="form-control" type="text" name="uname" placeholder="User Name">
      </div>
      <div class="form-input">
        <input class="form-control" type="password" name="password" placeholder="Password">
      </div>
      <input class="form-btn" type="submit" value="Login" name="submit">
    </form>
    <div class="forgot-password">
      <span><a class="forgot-btn" href="forgotPassword.php">Forgot Password</a></span>
    </div>
    <div class="error">
      <?php foreach($error as $err) {?>
        <span class="err"><?php echo $err?></span><br>
      <?php }?>
    </div>

    <div class="login">
      <span>New User?</span>
      <a class="btn btn-primary" href="login.php">Register</a>
    </div>
  </div>
</body>
</html>