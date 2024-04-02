<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
require_once 'UpdateDetails.php';

$empCodeOriginal = $_GET['val'];

$codeTable = $conn->getCodeDetails($empCodeOriginal);
$salaryTable = $conn->getSalaryDetails($empCodeOriginal);
$empIdOriginal = $salaryTable[0]['employee_id'];
$employeeDetailsTable = $conn->getEmployeeDetails($empIdOriginal);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script><?php include 'index.js'; ?></script>
  <style>
    <?php include 'index.css';?>
  </style>
</head>
<body>
  <div class="container">
  <form class="employee-details" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <input type="hidden" name="employeeCodeOriginal" value="<?php echo $empCodeOriginal?>">   
      <input type="hidden" name="employeeIdOriginal" value="<?php echo $empIdOriginal?>">    
      <h2>Update Employee Details</h2>
      <span class="form-error"></span><br>

      <div class="flex">
        <label for="fname">First Name: </label><br>  
        <input class="fname" type="text" name="fname" value="<?php echo $employeeDetailsTable[0]['employee_first_name']?>"><br>
        <span class="error"><?php echo $fnameErr;?></span><br>
      </div>

      <div class="flex">
        <label for="lname">Last Name: </label><br>  
        <input class="lname" type="text" name="lname" value="<?php echo $employeeDetailsTable[0]['employee_last_name']?>"><br>
        <span class="error"><?php echo $lnameErr;?></span><br>
      </div>

      <div class="flex">
        <label for="code">Employee Code: </label><br> 
        <input class="code" type="text" name="code" value="<?php echo $codeTable[0]['employee_code']?>"><br>
        <span class="error"><?php echo $codeErr;?></span><br>
      </div>

      <div class="flex">
        <label for="codeName">Code Name: </label><br> 
        <input class="codeName" type="text" name="codeName" value="<?php echo $codeTable[0]['employee_code_name']?>"><br>
        <span class="error"><?php echo $codeNameErr;?></span><br>
      </div>

      <div class="flex">
        <label for="id">Id: </label><br>
        <input class="id" type="text" name="id" value="<?php echo $salaryTable[0]['employee_id']?>"><br>
        <span class="error"><?php echo $idErr;?></span><br>
      </div>

      <div class="flex">
        <label for="domain">Domain: </label><br> 
        <input class="domain" type="text" name="domain" value="<?php echo $codeTable[0]['employee_domain']?>"><br>
        <span class="error"><?php echo $domainErr;?></span><br>
      </div>

      <div class="flex">
        <label for="salary">Salary: </label><br>  
        <input class="salary" type="text" name="salary" value="<?php echo $salaryTable[0]['employee_salary']?>"><br>
        <span class="error"><?php echo $salaryErr;?></span><br>
      </div>

      <div class="flex">
        <label for="percent">Graduation Percentile:</label><br>  
        <input class="percent" type="text" name="percent" value="<?php echo $employeeDetailsTable[0]['Graduation_percentile']?>"><br>
        <span class="error"><?php echo $percentileErr;?></span><br>
      </div>
      <div class="flex">
        <span><?php echo $msg;?></span>
      </div>
      <input class="submit" type="submit" name="submit" value="Submit">
      <button><a href="index.php">Go Back</a></button>
    </form>
  </div>
</body>
</html>