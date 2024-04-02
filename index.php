<?php
// Including the Data.php file.
require_once 'Data.php';

// If a button for a query is clicked, then that query is executed by 
// function call.
if(isset($_POST['query1'])) 
  $query1 = $conn->query1();
if(isset($_POST['query2'])) 
  $query2 = $conn->query2();
if(isset($_POST['query3']))
  $query3 = $conn->query3();
if(isset($_POST['query4']))
  $query4 = $conn->query4();
if(isset($_POST['query5']))
  $query5 = $conn->query5();
if(isset($_POST['query6']))
  $query6 = $conn->query6();
if(isset($_POST['query7']))
  $query7 = $conn->query7();
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
    <form class="employee-details" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <h2>Employee Details</h2>
      <span class="form-error"></span><br>

      <div class="flex">
        <label for="fname">First Name: </label><br>  
        <input class="fname" type="text" name="fname"><br>
        <span class="error"><?php echo $fnameErr;?></span><br>
      </div>

      <div class="flex">
        <label for="lname">Last Name: </label><br>  
        <input class="lname" type="text" name="lname"><br>
        <span class="error"><?php echo $lnameErr;?></span><br>
      </div>

      <div class="flex">
        <label for="code">Employee Code: </label><br> 
        <input class="code" type="text" name="code"><br>
        <span class="error"><?php echo $codeErr;?></span><br>
      </div>

      <div class="flex">
        <label for="codeName">Code Name: </label><br> 
        <input class="codeName" type="text" name="codeName"><br>
        <span class="error"><?php echo $codeNameErr;?></span><br>
      </div>

      <div class="flex">
        <label for="id">Id: </label><br>
        <input class="id" type="text" name="id"><br>
        <span class="error"><?php echo $idErr;?></span><br>
      </div>

      <div class="flex">
        <label for="domain">Domain: </label><br> 
        <input class="domain" type="text" name="domain"><br>
        <span class="error"><?php echo $domainErr;?></span><br>
      </div>

      <div class="flex">
        <label for="salary">Salary: </label><br>  
        <input class="salary" type="text" name="salary"><br>
        <span class="error"><?php echo $salaryErr;?></span><br>
      </div>

      <div class="flex">
        <label for="percent">Graduation Percentile:</label><br>  
        <input class="percent" type="text" name="percent"><br>
        <span class="error"><?php echo $percentileErr;?></span><br>
      </div>

      <input class="submit" type="submit" name="submit" value="Submit">
    </form>
    <button class="code-button">Code Table</button>
    <button class="salary-button">Salary Table</button>
    <button class="details-button">Details Table</button>
    <div class="table employee-code-table">
      <h2>Employee Code Table</h2>
      <table>
        <tr>
          <th>Employee Code</th>
          <th>Employee Code Name</th>
          <th>Employee Domain</th>
          <th colspan="2" align="center">Operations</th>
        </tr>
        <?php foreach ($conn->showCodeTable() as $row) {?>
        <tr>
          <td><?php echo $row['employee_code'];?></td>
          <td><?php echo $row['employee_code_name'];?></td>
          <td><?php echo $row['employee_domain'];?></td>
          <td><a href="update.php?val=<?php echo $row['employee_code']?>">Edit/Update</a></td>
          <td><a href="delete.php?val=<?php echo $row['employee_code']?>">Delete</a></td>
        </tr>
        <?php }?>
      </table>
    </div>

    <div class="table employee-salary-table">
      <h2>Employee Salary Table</h2>
      <table>
        <tr>
          <th>Employee Id</th>
          <th>Employee Salary</th>
          <th>Employee Code</th>
        </tr>
        <?php foreach ($conn->showSalaryTable() as $row) {?>
        <tr>
          <td><?php echo $row['employee_id'];?></td>
          <td><?php echo $row['employee_salary'];?></td>
          <td><?php echo $row['employee_code'];?></td>
        </tr>
        <?php }?>
      </table>
    </div>

    <div class="table employee-details-table">
      <h2>Employee Details Table</h2>
      <table>
        <tr>
          <th>Employee Id</th>
          <th>Employee First Name</th>
          <th>Employee Last Name</th>
          <th>Employee Graduation Percentile</th>
        </tr>
        <?php foreach ($conn->showDetailsTable() as $row) {?>
        <tr>
          <td><?php echo $row['employee_id'];?></td>
          <td><?php echo $row['employee_first_name'];?></td>
          <td><?php echo $row['employee_last_name'];?></td>
          <td><?php echo $row['Graduation_percentile'];?></td>
        </tr>
        <?php }?>
      </table>
    </div>

    <h2>QUERIES</h2>
    <div class="ques">
      <p>WAQ to list all employee first name with salary greater than 50k. </p>
      <form action="" method="post">
        <input type="submit" name="query1" class="query-1-button"></input>
        <button id="query-1-show-table" onclick="return false">Show Table</button>
      </form>
      <div class="table query-1">
        <table>
          <tr>
            <th>Employee First Name</th>
            <th>Employee Salary</th>
          </tr>
          <?php foreach ($query1 as $row) {?>
          <tr>
            <td><?php echo $row['employee_first_name'];?></td>
            <td><?php echo $row['employee_salary'];?></td>
          </tr>
          <?php }?>
        </table>
      </div>
    </div>

    <div class="ques">
      <p>WAQ to list all employee last name with graduation percentile greater than 70%.</p>
      <form action="" method="post">
        <input type="submit" name="query2" class="query-2-button"></input>
        <button id="query-2-show-table" onclick="return false">Show Table</button>
      </form>
      <div class="table query-2">
        <table>
          <tr>
            <th>Employee Last Name</th>
            <th>Graduation Percentile</th>
          </tr>
          <?php foreach ($query2 as $row) {?>
          <tr>
            <td><?php echo $row['employee_last_name'];?></td>
            <td><?php echo $row['Graduation_percentile'];?></td>
          </tr>
          <?php }?>
        </table>
      </div>
    </div>

    <div class="ques">
      <p>WAQ to list all employee code name with graduation percentile less than 70%. </p>
      <form action="" method="post">
        <input type="submit" name="query3" class="query-3-button"></input>
        <button id="query-3-show-table" onclick="return false">Show Table</button>
      </form>
      <div class="table query-3">
        <table>
          <tr>
            <th>Employee Code Name</th>
            <th>Graduation Percentile</th>
          </tr>
          <?php foreach ($query3 as $row) {?>
          <tr>
            <td><?php echo $row['employee_code_name'];?></td>
            <td><?php echo $row['Graduation_percentile'];?></td>
          </tr>
          <?php }?>
        </table>
      </div>
    </div>

    <div class="ques">
      <p>WAQ to list all employee's full name that are not of domain Java. </p>
      <form action="" method="post">
        <input type="submit" name="query4" class="query-4-button"></input>
        <button id="query-4-show-table" onclick="return false">Show Table</button>
      </form>
      <div class="table query-4">
        <table>
          <tr>
            <th>Employee Full Name</th>
            <th>Employee Domain</th>
          </tr>
          <?php foreach ($query4 as $row) {?>
          <tr>
            <td><?php echo $row['employee_full_name'];?></td>
            <td><?php echo $row['employee_domain'];?></td>
          </tr>
          <?php }?>
        </table>
      </div>
    </div>

    <div class="ques">
      <p>WAQ to list all employee_domain with sum of it's salary. </p>
      <form action="" method="post">
        <input type="submit" name="query5" class="query-5-button"></input>
        <button id="query-5-show-table" onclick="return false">Show Table</button>
      </form>
      <div class="table query-5">
        <table>
          <tr>
            <th>Employee Domain</th>
            <th>Salary</th>
          </tr>
          <?php foreach ($query5 as $row) {?>
          <tr>
            <td><?php echo $row['employee_domain'];?></td>
            <td><?php echo $row['Salary']."k";?></td>
          </tr>
          <?php }?>
        </table>
      </div>
    </div>

    <div class="ques">
      <p>Write the above query again but dont include salaries which is less than 30k. </p>
      <form action="" method="post">
        <input type="submit" name="query6" class="query-6-button"></input>
        <button id="query-6-show-table" onclick="return false">Show Table</button>
      </form>
      <div class="table query-6">
        <table>
          <tr>
            <th>Employee Domain</th>
            <th>Salary</th>
          </tr>
          <?php foreach ($query6 as $row) {?>
          <tr>
            <td><?php echo $row['employee_domain'];?></td>
            <td><?php echo $row['Salary'];?></td>
          </tr>
          <?php }?>
        </table>
      </div>
    </div>

    <div class="ques">
      <p>WAQ to list all employee id which has not been assigned employee code. </p>
      <form action="" method="post">
        <input type="submit" name="query7" class="query-7-button"></input>
        <button id="query-7-show-table" onclick="return false">Show Table</button>
      </form>
      <div class="table query-7">
        <table>
          <tr>
            <th>Employee Id</th>
          </tr>
          <?php foreach ($query7 as $row) {?>
          <tr>
            <td><?php echo $row['employee_id'];?></td>
          </tr>
          <?php }?>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
