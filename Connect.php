<?php

class Connection {
  public $conn;
  public function __construct() {
    $servername = "localhost";
    $username = "sayan";
    $password = "password";
    try{
      $this->conn = new PDO("mysql:host=$servername;dbname=IPL", $username, $password);
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
    // $sql3 = "SELECT f.Venue, f.Dates, f.Team1, t.Captain as CT1, f.Team2, f.Toss_won, f.Match_won from fixture as f inner join Teams as t where f.Team1=t.Team_name and f.Team2=t.Team_name;";
    $sql3 = "SELECT f.Venue, f.Dates, f.Team1, t1.Captain as TC1, t1.Captain as TC2, f.Team2, f.Toss_won, f.Match_won from fixture as f inner join Teams as t1 on f.Team1=t1.Team_name;";
    $stmt3 = $this->conn->prepare($sql3);
    $stmt3->execute();
    $result3 = $stmt3->fetchAll();
    return $result3;
  }
}