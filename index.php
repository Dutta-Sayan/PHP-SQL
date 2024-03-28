<?php
  require_once 'Connect.php';
  
  // Stores the connection class object.
  $connect = new Connection();
  // Storing the query result for showing Team names with captains.
  $result1 = $connect->showTeams();
  // Storing the query result for showing the fixtures of matches.
  $result2 = $connect->showFixture();
  // Storing the query result for showing the fixtures of matches along with the
  // names of the captains of the two playing teams.
  $result3 = $connect->showExtendedFixture();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    <?php include 'style.css'; ?>
  </style>
</head>
<body>
  <div class="container">
    <h2>IPL FIXTURES</h2>
    <!-- Displaying the Teams table containing team name and captains. -->
    <table>
      <thead>
        <tr>
          <th>Team Name</th>
          <th>Captain</th>
        </tr>
      </thead>
      <?php foreach ($result1 as $row) {?>
        <tr>
          <td><?php echo $row['Team_name']; ?></td>
          <td><?php echo $row['Captain']; ?></td>
        </tr>
      <?php }?>
    </table>

    <!-- Showing the Fixture table. -->
    <table>
      <thead>
        <tr>
          <th>Venue</th>
          <th>Date</th>
          <th>Team1</th>
          <th>Team2</th>
          <th>Toss Won</th>
          <th>Match won</th>
        </tr>
      </thead>
      <?php foreach ($result2 as $row) {?>
        <tr>
          <td><?php echo $row['Venue']; ?></td>
          <td><?php echo $row['Dates']; ?></td>
          <td><?php echo $row['Team1']; ?></td>
          <td><?php echo $row['Team2']; ?></td>
          <td><?php echo $row['Toss_won']; ?></td>
          <td><?php echo $row['Match_won']; ?></td>
        </tr>
      <?php }?>
    </table>

    <!-- Displaying the combined table with fixtures including the captain names -->
    <table>
      <thead>
        <tr>
          <th>Venue</th>
          <th>Date</th>
          <th>Team1</th>
          <th>Team 1 Captain</th>
          <th>Team2</th>
          <th>Team 2 Captain</th>
          <th>Toss Won</th>
          <th>Match won</th>
        </tr>
      </thead>
      <?php foreach ($result3 as $row) {?>
        <tr>
          <td><?php echo $row['venue']; ?></td>
          <td><?php echo $row['dates']; ?></td>
          <td><?php echo $row['team1']; ?></td>
          <td><?php echo $row['TC1']; ?></td>
          <td><?php echo $row['team2']; ?></td>
          <td><?php echo $row['TC2']; ?></td>
          <td><?php echo $row['toss_won']; ?></td>
          <td><?php echo $row['match_won']; ?></td>
        </tr>
      <?php }?>
    </table>
  </div>
</body>
</html>
