<?php

/**
 * Class for validation of input fields.
 */
class Validate {

  /**
   * Stores the error value if any, else null.
   * 
   * @var string
   */
  // public $err;

  /**
   * Checks for valid first name.
   * 
   * @param string $fname
   *  Contains the first name.
   * 
   * @return string $err
   *  Returns the error value.
   */
  public function isValidFname(string $fname) {
    $err="";
    // Pattern for first name.
    $pattern = "/^[a-zA-Z ]{1,20}$/";
    // Maximum 20 characters allowed for first name.
    if(strlen($fname)>20)
      $err = "*Maximum 20 characters";
    // Checking for valid first name expression.
    else if(!preg_match($pattern, $fname))
      $err = "*Incorrect first name";
    return $err; 
  }

  /**
   * Checks for valid last name.
   * 
   * @param string $lname
   *  Contains the last name.
   * 
   * @return string $err
   *  Returns the error value.
   */
  public function isValidLname(string $lname) {
    $err="";
    // Pattern for last name.
    $pattern = "/^[a-zA-Z ]{1,20}$/";
    // Maximum 20 characters allowed for last name.
    if(strlen($lname)>20)
      $err = "*Maximum 20 characters";
    // Pattern match checking for last name.
    else if(!preg_match($pattern, $lname))
      $err = "*Incorrect last name";
    return $err; 
  }

  /**
   * Checks for valid employee code.
   * 
   * @param string $code
   *  Contains the employee code.
   * 
   * @return string $err
   *  Returns the error value.
   */
  public function isValidCode(string $code) {
    $err="";
    // Pattern for employee code.
    $pattern = "/^(su_)[a-zA-Z]+$/";
    // Employee code allowed for a maximum length of 20 characters.
    if(strlen($code)>20)
      $err = "*Maximum 20 characters";
    else if(!preg_match($pattern, $code))
      $err = "*Incorrect code";
    return $err; 
  }

  /**
   * Checks for valid employee code name.
   * 
   * @param string $codeName
   *  Contains the employee code name.
   * 
   * @return string $err
   *  Returns the error value.
   */
  public function isValidCodeName(string $codeName) {
    $err="";
    // Pattern for employee code name.
    $pattern = "/^[a-z]{1}(u_)[a-zA-Z]+$/";
    if(strlen($codeName)>20)
      $err = "*Maximum 20 characters";
    else if(!preg_match($pattern, $codeName))
      $err = "*Incorrect code name";
    return $err; 
  }

  /**
   * Checks for valid employee id.
   * 
   * @param string $id
   *  Contains the employee id.
   * 
   * @return string $err
   *  Returns the error value.
   */
  public function isValidId(string $id) {
    $err="";
    // Pattern for Employee Id.
    $pattern = "/^(RU)[1-9]{3}$/";
    // Maximum 5 characters allowed for domain name value.
    if(strlen($id)>5)
      $err = "*Maximum 5 characters";
    else if(!preg_match($pattern, $id))
      $err = "*Id not valid";
    return $err; 
  }

  /**
   * Checks for valid domain.
   * 
   * @param string $domain
   *  Contains the domain name.
   * 
   * @return string $err
   *  Returns the error value.
   */
  public function isValidDomain(string $domain) {
    $err="";
    // Maximum 20 characters for domain name.
    if(strlen($domain)>20)
      $err = "*Maximum 20 characters";
    return $err; 
  }

  /**
   * Checks for valid salary input.
   * 
   * @param string $salary
   *  Contains the salary value.
   * 
   * @return string $err
   *  Returns the error value.
   */
  public function isValidSalary(string $salary) {
    $err="";
    // Pattern for salary.
    $pattern = "/^[0-9]{1,3}k$/";
    if(strlen($salary)>3)
      $err = "*Maximum 3 characters";
    else if(!preg_match($pattern, $salary))
      $err = "*Salary not correct";
    return $err; 
  }

  /**
   * Checks for valid percentile.
   * 
   * @param string $percentile
   *  Contains the percentile value.
   * 
   * @return string $err
   *  Returns the error value.
   */
  public function isValidPercentile(string $percentile) {
    $err="";
    // Pattern for percentile value.
    $pattern = "/^[0-9]{2}%$/";
    // Maximum 3 characters for percentile value including '%' character.
    if(strlen($percentile)>3)
      $err = "*Maximum 3 characters";
    else if(!preg_match($pattern, $percentile))
      $err = "*Incorrect percentile";
    return $err; 
  }
}