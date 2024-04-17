<?php
// Including the Connection.php and Validation.php file.
require_once 'Connection.php';
require_once 'Validation.php';

if (isset($_POST['submit'])) {
  // Storing the username.
  $username = $_POST['uname'];
  // Storing the password.
  $password = $_POST ['password'];
  // Storing the retyped password.
  $retypePassword = $_POST['rpassword'];
  // Storing the email.
  $email = $_POST['email'];
  // Storing object of Validation class.
  $error = new Validation();
  // Calling funcction to check for errors in the fields entered.
  $res = $error->checkRegistrationError($username, $password, $retypePassword, $email);
  
  // True denotes that the user is registered.
  if ($res === TRUE) {
    $msg = "User Registered";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
      <?php include './index.js';?>
    </script>
    <style>
      <?php include './Utils/CSS/index.css';?>
    </style>
  </head>
  <body>
    <div class="container">
      <h2>New Registration</h2>
      <form class="user-registration-form" action="index.php" method="post">
        
        <div class="form-input">
          <input class=" username form-control" type="text" name="uname" placeholder="User Name" 
          value="<?php echo $username?>" maxlength=25 pattern="^[a-zA-Z_ ]{1,25}$" required>
        </div>

        <div class="form-input">
          <input class="email form-control" type="email" name="email" placeholder="Email" 
          value="<?php echo $email?>" required>
        </div>

        <div class="form-input">
          <input class="password form-control" type="password" name="password" maxlength=30 
          placeholder="Password (Minimum 8 and maximum 30 characters)"  value="<?php echo $password?>" required>
        </div>

        <div class="form-input">
          <input class="form-control" type="password" name="rpassword" maxlength=30 
          value="<?php echo $retypePassword?>" placeholder="Retype password" required>
        </div>

        <input class="form-btn" type="submit" value="Register" name="submit">
      </form>

      <div class="error input-err">
        <?php foreach ($res as $err) {?>
          <span class="err"><?php echo $err?></span><br>
        <?php }?>
      </div>

      <div class="msg">
          <span class="message"><?php echo $msg?></span><br>
      </div>

      <div class="login">
        <span>Already registered?</span>
        <a class="btn btn-primary" href="login.php">Login</a>
      </div>
    </div>
  </body>
</html>
