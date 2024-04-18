<?php
// Including the Connection.php and Mail.php files.
require_once 'Connection.php';
require_once 'Mail.php';

if(isset($_POST['submit'])) {
  // Storing object of Connection class.
  $conn = new Connection();
  // Storing the email.
  $email = $_POST['email'];
  // Genarating random token for verifying the correct user and email.
  $token = bin2hex(random_bytes(16));
  // Converting it into hashcode to be stored in database.
  $tokenHash = hash("sha256", $token);
  // Setting the time limit for token validity.
  $expiry = date("Y-m-d H:i:s", time() + 60 * 30);
  $result = $conn->resetPasswordDetails($tokenHash, $expiry, $email);
  if ($result == 0) {
    $err = "*Email not found";
  }
  else {
    // Passing the valid mail to Mail class to sent the password reset link.
    $mail = new Mail($email);
    $message = $mail->resetPasswordEmail($token);
    if ($message == 1)
      $msg = "Password reset link sent to $email";
    else
      $msg = $message;
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
      <h4>Reset Password</h4>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <input class="password-reset-input" type="email" name="email" placeholder="Enter your email">
        <input class="btn btn-primary" type="submit" name="submit" value="Submit">
      </form>

      <div class="msg">
          <span class="message"><?php echo $msg?></span><br>
      </div>

      <div class="error">
        <span class="err"><?php echo $err?></span>
      </div>
    </div>
  </body>
</html>