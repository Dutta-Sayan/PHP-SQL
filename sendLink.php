<?php
require_once 'Connection.php';
$token = $_GET['token'];
$tokenHash = hash("sha256",$token);
$conn = new Connection();
$result = $conn->checkToken($tokenHash);

if(count($result)==0) {
  die("Token not found");
}
if (strtotime($result[0]['tokenExpiry'])<=time()) {
  die("token expired");
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
    <h2>New Password</h2>
    <form action="updatePassword.php" method="post">
      <input type="hidden" name="token" value="<?php echo htmlspecialchars($token);?>">
      <div class="form-input">
        <input class="form-control" type="password" name="password" placeholder="New Password">
      </div>
      <div class="form-input">
        <input class="form-control" type="password" name="rpassword" placeholder="Retype Password">
      </div>
      <input class="form-btn" type="submit" value="Login" name="submit">
    </form>
    <div class="error">
      <?php foreach($error as $err) {?>
        <span class="err"><?php echo $err?></span><br>
      <?php }?>
    </div>
  </div>
</body>
</html>