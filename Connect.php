<?php

class Connect {
  private $conn;

  public function __construct(string $server, string $user, string $password, string $db) {
    try{
      $this->conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);
    }
    catch(PDOException $e) {
      die("Connection failed " . $e->getMessage());
    }
  }

  public function insertCodeTable($code, $codeName, $domain) {
    $sql = "INSERT INTO employee_code_table(employee_code, employee_code_name, employee_domain)
     VALUES(:code, :codeName, :domain);";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
      ':code'=>$code,
      ':codeName'=>$codeName,
      ':domain'=>$domain
    ]);
  }
  public function insertSalaryTable($id, $salary, $code) {
    $sql = "INSERT INTO employee_salary_table (employee_id, employee_salary, employee_code)
    VALUES(:id, :salary, :code);";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
      ':id'=>$id,
      ':salary'=>$salary,
      ':code'=>$code
    ]);
  }
  public function insertDetailsTable($id, $fname, $lname, $percentile) {
    $sql = "INSERT INTO employee_details_table(employee_id, employee_first_name, employee_last_name, Graduation_percentile)
     VALUES(:id, :fname, :lname, :percentile);";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
      ':id'=>$id,
      ':fname'=>$fname,
      ':lname'=>$lname,
      ':percentile'=>$percentile
    ]);
  }

  public function showCodeTable() {
    $sql = "SELECT * FROM employee_code_table;";
    $res = $this->conn->prepare($sql);
    $res->execute();
    return $res->fetchAll();
  }
  public function showDetailsTable() {
    $sql = "SELECT * FROM employee_details_table;";
    $res = $this->conn->prepare($sql);
    $res->execute();
    return $res->fetchAll();
  }
  public function showSalaryTable() {
    $sql = "SELECT * FROM employee_salary_table;";
    $res = $this->conn->prepare($sql);
    $res->execute();
    return $res->fetchAll();
  }
}