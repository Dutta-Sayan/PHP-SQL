<?php

require_once realpath(__DIR__ . "/vendor/autoload.php");
use Dotenv\Dotenv;$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

/**
 * Class for connecting with the database and executing the queries.
 */
class Connection {
  public $conn;
  public function __construct() {
    $servername = $_ENV['SERVERNAME'];
    $username = $_ENV['USERNAME'];
    $password = $_ENV['PASSWORD'];
    $database = $_ENV['DATABASE'];
    try{
      $this->conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  public function showTeams() {
    $sql1 = "SELECT * from Teams; ";
    $stmt1 = $this->conn->prepare($sql1);
    $stmt1->execute();
    $result1 = $stmt1->fetchAll();
    return $result1;
  }

  public function showFixture() {
    $sql2 = "SELECT * from fixture; ";
    $stmt2 = $this->conn->prepare($sql2);
    $stmt2->execute();
    $result2 = $stmt2->fetchAll();
    return $result2;
  }

  public function showExtendedFixture() {
    $sql3 = "SELECT venue, dates, team1, t.captain as TC1, team2, t1.captain as TC2, toss_won, match_won from fixture as f inner join Teams as t on f.Team1=t.Team_name inner join Teams as t1 on f.Team2=t1.Team_name;";
    $stmt3 = $this->conn->prepare($sql3);
    $stmt3->execute();
    $result3 = $stmt3->fetchAll();
    return $result3;
  }
}