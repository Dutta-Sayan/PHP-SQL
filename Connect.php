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
}