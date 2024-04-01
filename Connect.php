<?php
/**
 * Using the Dotenv package for storing and using the database credentials 
 * securely.
 */
require_once realpath(__DIR__ . "/vendor/autoload.php");
use Dotenv\Dotenv;$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

/**
 * Class for connecting with the database and executing the queries.
 */
class Connection {
  /**
   * @var object $conn
   *  Stores the database connection.
   * 
   * @return object
   *  Returns the object of Connection class.
   */
  public $conn;

  /**
   * Connection to database is being made in the constructor.
   */
  public function __construct() {
    // Stores the servername.
    $servername = $_ENV['SERVERNAME'];
    // Stores the username for database connection.
    $username = $_ENV['USERNAME'];
    // Stores the password required for connection.
    $password = $_ENV['PASSWORD'];
    // Stores the database name to be connected to.
    $database = $_ENV['DATABASE'];
    try {
      // Creating the connection to database using PDO.
      $this->conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  /**
   * Handles the query to display all teams with captains from database table.
   * 
   * @return array
   *  Returns the query result as an array.
   */
  public function showTeams(): array{
    $sql = "SELECT * from Teams; ";
    // Function call for query execution.
    return $this->executeQuery($sql);
  }

  /**
   * Handles the query to display all match fixtures from the database table.
   * 
   * @return array
   *  Returns the query result as an array.
   */
  public function showFixture(): array{
    $sql = "SELECT * from fixture;";
    // Function call for query execution.
    return $this->executeQuery($sql);
  }

  /**
   * Handles the queryto show all the match fixtures along with the respective
   * team captain names. 
   * 
   * @return array
   *  Returns the query result as an array.
   */
  public function showExtendedFixture(): array{

    $sql = "SELECT venue, dates, team1, t.captain as TC1, team2, t1.captain as 
    TC2, toss_won, match_won from fixture as f inner join Teams as t on 
    f.Team1=t.Team_name inner join Teams as t1 on f.Team2=t1.Team_name;";
    // Function call for query execution.
    return $this->executeQuery($sql);
  }

  /**
   * Function for query execution.
   * 
   * @param string $sql
   *  Contains the sql query for execution.
   * 
   * @return array
   *  Returns the query result as an array.
   */
  public function executeQuery(string $sql): array{
    // Query execution;
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    // Returning the query result as an array.
    return $stmt->fetchAll();
  }
}