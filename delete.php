<?php
// Including the Connect.php and Validate.php files.
require_once 'Connect.php';
require_once 'Validate.php';

require_once realpath(__DIR__ . "/vendor/autoload.php");
// Using the Dotenv package to load environment variables from .env file.
use Dotenv\Dotenv;$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Storing the servername.
$servername = $_ENV['SERVERNAME'];
// Storing the username.
$username = $_ENV['USERNAME'];
// Storing the password.
$password = $_ENV['PASSWORD'];
// Storing the database name.
$dbname = $_ENV['DATABASE'];

// Storing the object of Connect class.
$conn = new Connect($servername, $username, $password, $dbname);
$empCode = $_GET['val'];
$msg = $conn->deleteRecord($empCode);

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
    <?php echo $msg?>
    <button><a href="index.php">Go Back</a></button>
  </div>
</body>
</html>