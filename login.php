<?php
// Including the Validation.php file.
require_once 'Validation.php';

  if(isset($_POST['submit'])) {
    // Storing the username and password.
    $username = $_POST['uname'];
    $password = $_POST['password'];

    // Storing object of Validation class.
    $error = new Validation();
    // Calling function to check for login errors
    $res = $error->checkLoginError($username, $password);

    // 'True' denotes no error has been found and successfull login.
    if($res === TRUE) {
      session_start();
      $_SESSION['userName'] = $username;
      // Redirecting to the User details form on successful login.
      header('location: form.php');
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
    <?php include './Utils/CSS/index.css';?>
  </style>
</head>
<body>
<div class="container">
    <h2>User Login</h2>
    <form action="login.php" method="post">

      <div class="form-input">
        <input class="form-control" type="text" name="uname" placeholder="User Name" value="<?php echo $username?>" maxlength=25 pattern="^[a-zA-Z_ ]{1,25}$" required">
      </div>

      <div class="form-input">
        <input class="form-control" type="password" name="password" value="<?php echo $password?>" placeholder="Password" required>
      </div>

      <input class="form-btn" type="submit" value="Login" name="submit">
    </form>

    <div class="forgot-password">
      <span><a class="forgot-btn" target="_blank" href="forgotPassword.php">Forgot Password</a></span>
    </div>

    <div class="error">
      <?php foreach($res as $err) {?>
        <span class="err"><?php echo $err?></span><br>
      <?php }?>
    </div>

    <div class="register">
      <span>New User?</span>
      <a class="btn btn-primary" href="index.php">Register</a>
    </div>
  </div>
</body>
</html>
