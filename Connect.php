<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Class for database connections and manipulating database.
 */
class Connect {
  /**
   * Stores the connection PDO.
   * 
   * @var object
   */
  private $conn;

  /**
   * Constructor for database connection.
   * 
   * @param string $server
   *  Stores the server name.
   * 
   * @param string $user
   *  Stores the username of database.
   * 
   * @param $password
   *  Stores the password to connect to database.
   * 
   * @param string $db
   *  Stores the required database name.
   */
  public function __construct(string $server, string $user, string $password, string $db) {
    try{
      // Making the database connection.
      $this->conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);
    }
    catch(PDOException $e) {
      die("Connection failed " . $e->getMessage());
    }
  }

  /**
   * Fucntion to insert values in the Employee Code table.
   * 
   * @param string $code
   *  Contains the employee name.
   * 
   * @param string $codeName
   *  Contains the employee code name.
   * 
   * @param string $domain
   *  Contains the domain of the employee.
   */
  public function insertCodeTable($code, $codeName, $domain) {
    // Sql query to insert values in the employee code table.
    $sql = "INSERT INTO employee_code_table(employee_code, employee_code_name, employee_domain)
     VALUES(:code, :codeName, :domain);";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
      ':code'=>$code,
      ':codeName'=>$codeName,
      ':domain'=>$domain
    ]);
  }

  /**
   * Function to insert values in the employee salary table.
   * 
   * @param string $id
   *  Contains the employee id.
   * 
   * @param string $salary
   *  Contains the employee salary.
   * 
   * @param string $code
   *  Contains the employee code.
   */
  public function insertSalaryTable($id, $salary, $code) {
    // Sql query to insert values in the employee salary table.
    $sql = "INSERT INTO employee_salary_table (employee_id, employee_salary, employee_code)
    VALUES(:id, :salary, :code);";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
      ':id'=>$id,
      ':salary'=>$salary,
      ':code'=>$code
    ]);
  }

  /**
   * Function to insert values in employee details table.
   * 
   * @param string $id
   *  Contains the employee id.
   * 
   * @param string $fname
   *  Contains the employee first name.
   * 
   * @param string $lname
   *  Contains the employee last name.
   * 
   * @param string $percentile
   *  Contains the employee percentile.
   */
  public function insertDetailsTable($id, $fname, $lname, $percentile) {
    // Sql query to insert values in the employee data table.
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

  /**
   * Function to display Employee code table.
   * 
   * @return array
   *  Returns all the rows of employee code table as an associative array.
   */
  public function showCodeTable() {
    // Query to select all rows and columns from employee code table.
    $sql = "SELECT * FROM employee_code_table;";
    // Function call for query execution and returns the result as an array.
    return $this->queryExecution($sql); 
  }

  /**
   * Function to display Employee details table.
   * 
   * @return array
   *  Returns all the rows of employee details table as an associative array.
   */
  public function showDetailsTable() {
    // Query to select all rows and columns from employee details table.
    $sql = "SELECT * FROM employee_details_table;";
    // Function call for query execution and returns the result as an array.
    return $this->queryExecution($sql); 
  }

  /**
   * Function to display Employee salary table.
   * 
   * @return array
   *  Returns all the rows of employee details table as an associative array.
   */
  public function showSalaryTable() {
    // Query to select all rows and columns from employee salary table.
    $sql = "SELECT * FROM employee_salary_table;";
    // Function call for query execution and returns the result as an array.
    return $this->queryExecution($sql); 
  }

  /**
   * Function for query 1.
   * 
   * @return array
   *  Returns all the rows of employee details table as an associative array.
   */
  public function query1() {
    $sql = "SELECT d.employee_first_name, s.employee_salary from 
    employee_details_table as d INNER JOIN employee_salary_table as s ON
    d.employee_id=s.employee_id WHERE employee_salary>'50000';";
    return $this->queryExecution($sql); 
  }

  /**
   * Function for query 2.
   * 
   * @return array
   *  Returns all the rows of employee details table as an associative array.
   */
  public function query2() {
    $sql = "SELECT employee_last_name, Graduation_percentile from 
    employee_details_table WHERE Graduation_percentile>'70';";
    return $this->queryExecution($sql); 
  }

  /**
   * Function for query 3.
   * 
   * @return array
   *  Returns all the rows of employee details table as an associative array.
   */
  public function query3() {
    $sql = "SELECT c.employee_code_name, d.Graduation_percentile from 
    ((employee_code_table as c inner join employee_salary_table as s on 
    c.employee_code=s.employee_code) inner join employee_details_table as d on 
    s.employee_id=d.employee_id) where Graduation_percentile<'70';";
    return $this->queryExecution($sql); 
  }

  /**
   * Function for query 4.
   * 
   * @return array
   *  Returns all the rows of employee details table as an associative array.
   */
  public function query4() {
    $sql = "SELECT CONCAT(employee_first_name,' ',employee_last_name) as 
    employee_full_name, employee_domain from ((employee_code_table as c inner join 
    employee_salary_table as s on c.employee_code=s.employee_code) inner join 
    employee_details_table as d on s.employee_id=d.employee_id)  where 
    not employee_domain='Java';";
    return $this->queryExecution($sql); 
  }

  /**
   * Function for query 5.
   * 
   * @return array
   *  Returns all the rows of employee details table as an associative array.
   */
  public function query5() {
    $sql = "SELECT employee_domain, SUM(employee_salary) as Salary from
    (employee_code_table as c inner join employee_salary_table as s on
    c.employee_code=s.employee_code) group by employee_domain ;";
    return $this->queryExecution($sql); 
  }

  /**
   * Function for query 6.
   * 
   * @return array
   *  Returns all the rows of employee details table as an associative array.
   */
  public function query6() {
    $sql = "SELECT employee_domain, SUM(employee_salary) as Salary from
    (employee_code_table as c inner join employee_salary_table as s on
    c.employee_code=s.employee_code) where employee_salary>'30000' 
    group by employee_domain ;";
    return $this->queryExecution($sql); 
  }

  /**
   * Function for query 7.
   * 
   * @return array
   *  Returns all the rows of employee details table as an associative array.
   */
  public function query7() {
    $sql = "SELECT employee_id from employee_salary_table where employee_code
    not in (select employee_code from employee_code_table) ;";
    return $this->queryExecution($sql); 
  }

  /**
   * Function for query preparation and execution to get the result.
   * 
   * @param string $query
   *  Contains the query string.
   * 
   * @return array
   *  Returns the query result as an associative array.
   */
  public function queryExecution($query) {
    $res = $this->conn->prepare($query);
    $res->execute();
    return $res->fetchAll();
  }
}

