<?php
require_once 'Connect.php';
require_once 'Validate.php';
$servername = "localhost";
$username = "sayan";
$password = "password";
$dbname = "Employee";

$conn = new Connect($servername, $username, $password, $dbname);
$valid = new Validate();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $empFname = trim($_POST['fname']);
  $empLname = trim($_POST['lname']);
  $empCode = trim($_POST['code']);
  $empCodeName = trim($_POST['codeName']);
  $empId = trim($_POST['id']);
  $empDomain = trim($_POST['domain']);
  $empSalary = trim($_POST['salary']);
  $empPercentile = trim($_POST['percent']);

  $fnameErr = $valid->isValidFname($empFname);
  $lnameErr = $valid->isValidLname($empLname);
  $codeErr = $valid->isValidCode($empCode, $empFname);
  $codeNameErr = $valid->isValidCodeName($empCodeName ,$empFname);
  $idErr = $valid->isValidId($empId);
  $domainErr = $valid->isValidDomain($empDomain);
  $salaryErr = $valid->isValidSalary($empSalary);
  $percentileErr = $valid->isValidPercentile($empPercentile);


  $conn->insertCodeTable($empCode, $empCodeName, $empDomain);
  $conn->insertSalaryTable($empId, $empSalary, $empCode);
  $conn->insertDetailsTable($empId, $empFname, $empLname, $empPercentile);
}