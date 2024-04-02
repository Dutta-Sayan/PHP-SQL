<?php
require_once realpath(__DIR__ . "/vendor/autoload.php");
use Dotenv\Dotenv;$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

/**
 * Class for database connections and manipulating database.
 */
class Connection {

  /**
   * Stores the connection PDO. 
   * 
   * @var object
   */
  public $conn;

  /**
   * Creates the database connection.
   */
  public function __construct() {
    // Stores the servername from .env file.
    $servername = $_ENV['SERVERNAME'];
    // Stores the username from .env file.
    $username = $_ENV['USERNAME'];
    // Stores the password from .env file.
    $password = $_ENV['PASSWORD'];
    // Stores the dataabse name from .env file.
    $db = $_ENV['DATABASE'];

    try {
      // Making the database connection.
      $this->conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  /**
   * Checks if the user exists in database.
   * 
   * @param string $user
   *  Contains the username to be checked for.
   * 
   * @return array
   *  Returns the array of the row containing the username.
   */
  public function checkUser(string $username): array {
    $sql = "SELECT * from Register where username='$username';";
    // Preparing the query for execution.
    $stmt = $this->conn->prepare($sql);
    // Executing the query.
    $stmt->execute();
    // Converting and storing the result as array.
    $result = $stmt->fetchAll();
    return $result;
  }

  /**
   * Inserting a new user in database.
   * 
   * @param string $username
   *  Contains the user name.
   * 
   * @param string $password
   *  Contains the password.
   * 
   * @param string $email
   *  Contains the email.
   */
  public function insertUser(string $username, string $password, string $email) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT into Register(username,userPassword,email) values ('$username', '$hashedPassword', '$email');";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
  }
  
  /**
   * Reset the password details if valid credentials are given.
   * 
   * @param string $tokenHash
   *  Contains the hashed token value.
   * 
   * @param string $expiry
   *  Contains the expiry time limit for the token to be valid.
   * 
   * @param string $email
   *  Contains the email address.
   * 
   * @return bool
   */
  public function resetPasswordDetails($tokenHash, $expiry, $email): bool {
    // Extracting the record for the given email to check if the email is of
    // a valid user.
    $sql1 = "SELECT * from Register where email='$email';";
    $stmt = $this->conn->prepare($sql1);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if(count($result)>0){
      // On valid user email, setting the token and expiry time for password
      // resetting.
      $sql2 = "UPDATE Register set resetToken='$tokenHash', tokenExpiry='$expiry' where email='$email';";
      $stmt = $this->conn->prepare($sql2);
      $stmt->execute();
      return 1;
    }
    else
      return 0;
  }

  /**
   * Checks is the token is valid or not.
   * 
   * @param string $tokenHash
   *  Contains the hashed token.
   * 
   * @return array
   *  Returns the respective row of the user with the matched token.
   */
  public function checkToken($tokenHash):array {
    $sql = "SELECT * from Register where resetToken='$tokenHash';";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  /**
   * Updates the password for the respective token value.
   * 
   * @param string $password
   *  Contains the password.
   * 
   * @param string $tokenHash
   *  Contains the hashed token.
   */
  public function updatePassword($password, $tokenHash) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // After resetting the email, setting the token and expiry value to null. 
    $sql = "UPDATE Register set userPassword='$hashedPassword', resetToken=NULL, tokenExpiry=NULL where resetToken='$tokenHash';";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
  }
}