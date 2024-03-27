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
    return $this->queryExecution($sql); 
  }
  public function showDetailsTable() {
    $sql = "SELECT * FROM employee_details_table;";
    return $this->queryExecution($sql); 
  }
  public function showSalaryTable() {
    $sql = "SELECT * FROM employee_salary_table;";
    return $this->queryExecution($sql); 
  }

  public function query1() {
    $sql = "SELECT d.employee_first_name, s.employee_salary from 
    employee_details_table as d INNER JOIN employee_salary_table as s ON
    d.employee_id=s.employee_id WHERE employee_salary>'50000';";
    return $this->queryExecution($sql); 
  }

  public function query2() {
    $sql = "SELECT employee_last_name, Graduation_percentile from 
    employee_details_table WHERE Graduation_percentile>'70';";
    return $this->queryExecution($sql); 
  }

  public function query3() {
    $sql = "SELECT c.employee_code_name, d.Graduation_percentile from 
    ((employee_code_table as c inner join employee_salary_table as s on 
    c.employee_code=s.employee_code) inner join employee_details_table as d on 
    s.employee_id=d.employee_id) where Graduation_percentile<'70';";
    return $this->queryExecution($sql); 
  }

  public function query4() {
    $sql = "SELECT CONCAT(employee_first_name,' ',employee_last_name) as 
    employee_full_name, employee_domain from ((employee_code_table as c inner join 
    employee_salary_table as s on c.employee_code=s.employee_code) inner join 
    employee_details_table as d on s.employee_id=d.employee_id)  where 
    not employee_domain='Java';";
    return $this->queryExecution($sql); 
  }

  public function query5() {
    $sql = "SELECT employee_domain, SUM(employee_salary) as Salary from
    (employee_code_table as c inner join employee_salary_table as s on
    c.employee_code=s.employee_code) group by employee_domain ;";
    return $this->queryExecution($sql); 
  }

  public function query6() {
    $sql = "SELECT employee_domain, SUM(employee_salary) as Salary from
    (employee_code_table as c inner join employee_salary_table as s on
    c.employee_code=s.employee_code) where employee_salary>'30000' 
    group by employee_domain ;";
    return $this->queryExecution($sql); 
  }

  public function query7() {
    $sql = "SELECT employee_id from employee_salary_table where employee_code
    not in (select employee_code from employee_code_table) ;";
    return $this->queryExecution($sql); 
  }

  public function queryExecution($query) {
    $res = $this->conn->prepare($query);
    $res->execute();
    return $res->fetchAll();
  }
}

