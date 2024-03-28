<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'Connection.php';

if(isset($_POST['submit'])) {
  $username = $_POST['uname'];
  $password = $_POST['password'];
  $retype_password = $_POST['rpassword'];
  $email = $_POST['email'];
  $error = array();
  if(empty($username) || empty($password) || empty($retype_password) || empty($email))
    array_push($error, "*Empty fields present");
  if(strlen($password)<8)
    array_push($error,"*Password must be atleast 8 characters");
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    array_push($error, "*Invalid email");
  if(count($error)==0) {
    $conn = new Connection();
    $result = $conn->checkUser($username);
    if(count($result)>0) {
      array_push($error, "*User already exists");
    }
    else {
      $conn->insertUser($username, $password);
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
    <h2>New Registration</h2>
    <form action="index.php" method="post">
      <div class="form-input">
        <input class="form-control" type="text" name="uname" placeholder="User Name">
      </div>
      <div class="form-input">
        <input class="form-control" type="email" name="email" placeholder="Email">
      </div>
      <div class="form-input">
        <input class="form-control" type="password" name="password" placeholder="Password">
      </div>
      <div class="form-input">
        <input class="form-control" type="password" name="rpassword" placeholder="Retype password">
      </div>
      <input class="form-btn" type="submit" value="Register" name="submit">
    </form>
    <div class="error">
      <?php foreach($error as $err) {?>
        <span class="err"><?php echo $err?></span><br>
      <?php }?>
    </div>

    <div class="login">
      <span>Already registered?</span>
      <a class="btn btn-primary" href="login.php">Login</a>
    </div>
  </div>
</body>
</html>