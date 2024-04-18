<?php
// Including the Connection.php file.
require_once 'Connection.php';

if(isset($_POST['submit'])) {
  // Store the token to be used for pasword reset validation.
  $token = $_POST['token'];
  // Store the hash value of the token.
  $tokenHash = hash("sha256",$token);
  // Store the object of Connection class.
  $conn = new Connection();
  // Checking if the token is valid or not.
  $result = $conn->checkToken($tokenHash);

  if(count($result) == 0) {
    die("Token not found");
  }
  // Checking if the token expiry time has exceeded limit or not.
  if (strtotime($result[0]['tokenExpiry'])<=time()) {
    die("token expired");
  }

  // Storing the passsword value entered.
  $password = $_POST['password'];
  // Storing the retyped password value.
  $retypePassword = $_POST['rpassword'];
  // Array to store the errors.
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