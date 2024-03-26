<?php
class Validate {
  public function isValidFname(string $fname) {
    $err="";
    $pattern = "/^[a-zA-Z ]{1,25}$/";
    if(!preg_match($pattern, $fname))
      $err = "Incorrect first name";
    return $err; 
  }
  public function isValidLname(string $lname) {
    $err="";
    $pattern = "/^[a-zA-Z ]{1,25}$/";
    if(!preg_match($pattern, $lname))
      $err = "Incorrect last name";
    return $err; 
  }
  public function isValidCode(string $code, string $fname) {
    $err="";
    $pattern = "/^(su_)$fname$/";
    if(!preg_match($pattern, $code))
      $err = "Incorrect code";
    return $err; 
  }
  public function isValidCodeName(string $codeName, string $fname) {
    $err="";
    $pattern = "/^[a-z]{1}(u_)$fname$/";
    if(!preg_match($pattern, $codeName))
      $err = "Incorrect code name";
    return $err; 
  }
  public function isValidId(string $id) {
    $err="";
    return $err; 
  }
  public function isValidDomain(string $domain) {
    $err="";
    return $err; 
  }
  public function isValidSalary(string $salary) {
    $err="";
    return $err; 
  }
  public function isValidPercentile(string $percentile) {
    $err="";
    return $err; 
  }
}