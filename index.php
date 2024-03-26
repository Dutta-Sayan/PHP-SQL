<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'data.php';
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
    <?php include './index.css'; ?>
  </style>
</head>
<body>
  <div class="container">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label for="fname">First Name: </label>  
      <input type="text" name="fname"><br>

      <label for="lname">Last Name: </label>  
      <input type="text" name="lname"><br>

      <label for="code">Employee Code: </label>  
      <input type="text" name="code"><br>

      <label for="codeName">Code Name: </label>  
      <input type="text" name="codeName"><br>

      <label for="id">Id: </label>  
      <input type="text" name="id"><br>

      <label for="domain">Domain: </label>  
      <input type="text" name="domain"><br>

      <label for="salary">Salary: </label>  
      <input type="text" name="salary"><br>

      <label for="percent">Graduation Percentile:</label>  
      <input type="text" name="percent"><br>

      <input type="submit" name="submit" value="Submit">
    </form>
    <button class="code-button">Code Table</button>
    <button class="salary-button">Salary Table</button>
    <button class="details-button">Details Table</button>
    <div class="employee-code-table">
      <h2>Employee Code Table</h2>
      <table>
        <tr>
          <th>Employee Code</th>
          <th>Employee Code Name</th>
          <th>Employee Domain</th>
        </tr>
        <?php foreach ($conn->showCodeTable() as $row)?>
        <tr>
          <td><?php echo $row['employee_code'];?></td>
          <td><?php echo $row['employee_code_name'];?></td>
          <td><?php echo $row['employee_domain'];?></td>
        </tr>
      </table>
    </div>

    <div class="employee-salary-table">
      <h2>Employee Salary Table</h2>
      <table>
        <tr>
          <th>Employee Id</th>
          <th>Employee Salary</th>
          <th>Employee Code</th>
        </tr>
        <?php foreach ($conn->showSalaryTable() as $row)?>
        <tr>
          <td><?php echo $row['employee_id'];?></td>
          <td><?php echo $row['employee_salary'];?></td>
          <td><?php echo $row['employee_code'];?></td>
        </tr>
      </table>
    </div>
    <div class="employee-details-table">
      <h2>Employee Details Table</h2>
      <table>
        <tr>
          <th>Employee Id</th>
          <th>Employee First Name</th>
          <th>Employee Last Name</th>
          <th>Employee Graduation Percentile</th>
        </tr>
        <?php foreach ($conn->showDetailsTable() as $row)?>
        <tr>
          <td><?php echo $row['employee_id'];?></td>
          <td><?php echo $row['employee_first_name'];?></td>
          <td><?php echo $row['employee_last_name'];?></td>
          <td><?php echo $row['Graduation_percentile'];?></td>
        </tr>
      </table>
    </div>
  </div>
</body>
</html>
