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
  public $err;

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
    // Pattern for first name.
    $pattern = "/^[a-zA-Z ]{1,20}$/";
    // Maximum 20 characters allowed for first name.
    if(strlen($fname)>20)
      $this->err = "*Maximum 20 characters";
    // Checking for valid first name expression.
    else if(!preg_match($pattern, $fname))
      $this->isValidFnameerr = "*Incorrect first name";
    return $this->err; 
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
    // Pattern for last name.
    $pattern = "/^[a-zA-Z ]{1,20}$/";
    // Maximum 20 characters allowed for last name.
    if(strlen($lname)>20)
      $this->err = "*Maximum 20 characters";
    // Pattern match checking for last name.
    else if(!preg_match($pattern, $lname))
      $this->err = "*Incorrect last name";
    return $this->err; 
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
    // Pattern for employee code.
    $pattern = "/^(su_)[a-zA-Z]+$/";
    // Employee code allowed for a maximum length of 20 characters.
    if(strlen($code)>20)
      $this->err = "*Maximum 20 characters";
    else if(!preg_match($pattern, $code))
      $this->err = "*Incorrect code";
    return $this->err; 
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
    // Pattern for employee code name.
    $pattern = "/^[a-z]{1}(u_)[a-zA-Z]+$/";
    if(strlen($codeName)>20)
      $this->err = "*Maximum 20 characters";
    else if(!preg_match($pattern, $codeName))
      $this->err = "*Incorrect code name";
    return $this->err; 
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
    // Pattern for Employee Id.
    $pattern = "/^(RU)[1-9]{3}$/";
    // Maximum 5 characters allowed for domain name value.
    if(strlen($id)>5)
      $this->err = "*Maximum 5 characters";
    else if(!preg_match($pattern, $id))
      $this->err = "*Id not valid";
    return $this->err; 
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
    // Maximum 20 characters for domain name.
    if(strlen($domain)>20)
      $this->err = "*Maximum 20 characters";
    return $this->err; 
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
    // Pattern for salary.
    $pattern = "/^[1-9]{1,3}(k)$/";
    if(strlen($salary)>3)
      $this->err = "*Maximum 3 characters";
    else if(!preg_match($pattern, $salary))
      $this->err = "*Salary not correct";
    return $this->err; 
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
    // Pattern for percentile value.
    $pattern = "/^[1-9]{2}(%)$/";
    // Maximum 3 characters for percentile value including '%' character.
    if(strlen($percentile)>3)
      $this->err = "*Maximum 3 characters";
    else if(!preg_match($pattern, $percentile))
      $this->err = "*Incorrect percentile";
    return $this->err; 
  }
}