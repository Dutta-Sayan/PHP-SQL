<?php

require_once 'Connection.php';

if(isset($_POST['submit'])) {
  $token = $_POST['token'];
  $tokenHash = hash("sha256",$token);
  $conn = new Connection();
  $result = $conn->checkToken($tokenHash);

  if(count($result)==0) {
    die("Token not found");
  }
  if (strtotime($result[0]['tokenExpiry'])<=time()) {
    die("token expired");
  }

  $password = $_POST['password'];
  $retypePassword = $_POST['rpassword'];
  $error = array();
  if(empty($password) || empty($retypePassword))
    array_push($error, "*Empty fields present");
  if(strlen($password)<8)
    array_push($error,"*Password must be atleast 8 characters");
  if($password !== $retypePassword)
    array_push($error,"*Password does not match");
  if(count($error)==0) {
    $conn->updatePassword($password, $tokenHash);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <div class="container">
    <p>Password sent successfully.</p>
    <a href="./login.php">Go back to Login</a>
  </div>
</body>
</html>