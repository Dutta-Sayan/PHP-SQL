<?php

// Including the Connection.php class.
require_once 'Connection.php';

/**
 * Class for checking input validations.
 */
class Validation {

  /**
   * Regex pattern to match the username against.
   * Username can contain small or capital alphabets, space and underscore.
   * 
   * @var string
   */
  private $uNamePattern = "/^[a-zA-Z_ ]{1,25}$/";

  /**
   * Checks if errors are present in the login input fields.
   * 
   * @param string $username
   *  Contains the username.
   * 
   * @param string $password
   *  Contains the password.
   * 
   * @return bool|array
   *  If login credentials are correct, then returns true.
   *  If error found, then returns the array containing error messages.
   */
  public function checkLoginError(string $username, string $password): mixed {
    // Array to contain error messages.
    $error = array();

    // Checking if username and password is empty or not.
    if($this->isempty($username, $password))
      array_push($error, "*Empty fields present");
    // Checking if the username matches the required pattern.
    if(!preg_match($this->uNamePattern, $username))
      array_push($error, "*Incorrect Username or Password");
    // If no error is found, connection is made to database.

    if(count($error) == 0) {
      $conn = new Connection();
      // Checks if username exists in database.
      $result = $conn->checkUser($username);

      if(count($result) > 0) {
        // For valid user, checks if password is valid or not.
        if($conn->checkPassword($password, $result[0]['userPassword']))
          return TRUE;
        else
        // For incorrect password, stores the error message in the array.
          array_push($error, "*Incorrect Username or Password");
      }
      else {
        // For invalid user, storing the error message in array.
        array_push($error, "*User does not exist");
      }
    }
    return $error;
  }

  /**
   * Checks if errors are present in the registration input fields.
   * 
   * @param string $username
   *  Contains the username.
   * 
   * @param string $password
   *  Contains the password.
   * 
   * @param string $retypePassword
   *  Contains the retyped password for confirmation.
   * 
   * @param string $email
   *  Contains the email address.
   * 
   * @return bool|array
   *  If registration field values are correct, then returns true.
   *  If error found, then returns the array containing error messages.
   */
  public function checkRegistrationError(string $username, string $password, string $retypePassword, string $email): mixed {
    // Array to contain error messages.
    $error = array();

    // Checking if any input field is empty or not.
    if($this->isempty($username, $password, $retypePassword, $email))
      array_push($error, "*Empty fields present");
    // Checking if username is matching the pattern or not. 
    if(!preg_match($this->uNamePattern, $username))
      array_push($error, "*Not a valid username");
    // Checking the length of password within the range.
    if(strlen($password)<8 || strlen($password)>30)
      array_push($error,"*Password not in range");

    // Checking if the password matches with the retyped password.
    if($password !== $retypePassword)
      array_push($error,"*Password does not match");
    // Checking email validity.
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
      array_push($error, "*Invalid email");

    if(count($error)==0) {
      // Establishing connection to database ifno errors found.
      $conn = new Connection();
      //Checking is user already exists.
      $result = $conn->checkUser($username);
      if(count($result)>0) {
        array_push($error, "*User already exists");
      }
      else {
        // If user is new, inserting the user details in database.
        $conn->insertUser($username, $password, $email);
        return TRUE;
      }
    }
    return $error;
  }

  /**
   * Checks if a variable is empty or not.
   * 
   * @param string $value
   *  Contains the variable to be checked for.
   * 
   * @return bool
   *  If the variable is empty, returns true, otherwise false.
   */
  public function isempty(string ...$value): bool {
    foreach ($value as $val) {
      if(!empty($val))
        return FALSE;
    }
    return TRUE;
  }
}