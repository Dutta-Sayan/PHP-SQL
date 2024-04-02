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
// Storing the object of Validate class.
$valid = new Validate();

if(isset($_POST['submit'])) {
  // Stores the employee first name.
  $empFname = trim($_POST['fname']);
  // Stores the employee last name.
  $empLname = trim($_POST['lname']);
  // Stores the employee code.
  $empCode = trim($_POST['code']);
  // Stores the employee code name.
  $empCodeName = trim($_POST['codeName']);
  // Stores the employee Id.
  $empId = trim($_POST['id']);
  // Stores the employee domain.
  $empDomain = trim($_POST['domain']);
  // Stores the employee salary.
  $empSalary = trim($_POST['salary']);
  // Stores the employee percent.
  $empPercentile = trim($_POST['percent']);

  // Function calls for different validation checks for the input fields values.
  $fnameErr = $valid->isValidFname($empFname);
  $lnameErr = $valid->isValidLname($empLname);
  $codeErr = $valid->isValidCode($empCode);
  $codeNameErr = $valid->isValidCodeName($empCodeName);
  $idErr = $valid->isValidId($empId);
  $domainErr = $valid->isValidDomain($empDomain);
  $salaryErr = $valid->isValidSalary($empSalary);
  $percentileErr = $valid->isValidPercentile($empPercentile);

  // If all error messages are empty, then insert data into database.
  if($fnameErr=="" && $lnameErr=="" && $codeErr=="" && $codeNameErr=="" && 
  $idErr=="" && $domainErr=="" && $salaryErr=="" && $percentileErr=="") {
    $conn->insertCodeTable($empCode, $empCodeName, $empDomain);
    $conn->insertSalaryTable($empId, $empSalary, $empCode);
    $conn->insertDetailsTable($empId, $empFname, $empLname, $empPercentile);
  }

}