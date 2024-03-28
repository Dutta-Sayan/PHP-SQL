<?php
require_once realpath(__DIR__ . "/vendor/autoload.php");
use Dotenv\Dotenv;$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
class Connection {

  private $conn;

  public function __construct() {
    $servername = $_ENV['SERVERNAME'];
    $username = $_ENV['USERNAME'];
    $password = $_ENV['PASSWORD'];
    $db = $_ENV['DATABASE'];

    try {
      $this->conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  public function checkUser($username) {
    $sql = "SELECT * from Register where username='$username';";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  }

  public function insertUser($username, $password) {
    $sql ="INSERT into Register(username,userPassword) values ('$username', '$password');";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
  }

  public function checkPassword($password, $passCheck) {
    if($password === $passCheck)
      return TRUE;
  }
}