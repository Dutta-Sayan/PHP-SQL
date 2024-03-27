<?php
class Validate {
  public function isValidFname(string $fname) {
    $err="";
    $pattern = "/^[a-zA-Z ]{1,20}$/";
    if(strlen($fname)>20)
      $err = "*Maximum 20 characters";
    else if(!preg_match($pattern, $fname))
      $err = "*Incorrect first name";
    return $err; 
  }
  public function isValidLname(string $lname) {
    $err="";
    $pattern = "/^[a-zA-Z ]{1,20}$/";
    if(strlen($lname)>20)
      $err = "*Maximum 20 characters";
    else if(!preg_match($pattern, $lname))
      $err = "*Incorrect last name";
    return $err; 
  }
  public function isValidCode(string $code) {
    $err="";
    $pattern = "/^(su_)[a-zA-Z]+$/";
    if(strlen($code)>20)
      $err = "*Maximum 20 characters";
    else if(!preg_match($pattern, $code))
      $err = "*Incorrect code";
    return $err; 
  }
  public function isValidCodeName(string $codeName) {
    $err="";
    $pattern = "/^[a-z]{1}(u_)[a-zA-Z]+$/";
    if(strlen($codeName)>20)
      $err = "*Maximum 20 characters";
    else if(!preg_match($pattern, $codeName))
      $err = "*Incorrect code name";
    return $err; 
  }
  public function isValidId(string $id) {
    $err="";
    $pattern = "/^(RU)[1-9]{3}$/";
    if(strlen($id)>5)
      $err = "*Maximum 5 characters";
    else if(!preg_match($pattern, $id))
      $err = "*Id not valid";
    return $err; 
  }
  public function isValidDomain(string $domain) {
    $err="";
    if(strlen($domain)>20)
      $err = "*Maximum 20 characters";
    return $err; 
  }
  public function isValidSalary(string $salary) {
    $err="";
    $pattern = "/^[1-9]{1,3}(k)$/";
    if(strlen($salary)>3)
      $err = "*Maximum 3 characters";
    else if(!preg_match($pattern, $salary))
      $err = "*Salary not correct";
    return $err; 
  }
  public function isValidPercentile(string $percentile) {
    $err="";
    $pattern = "/^[1-9]{2}(%)$/";
    if(strlen($percentile)>3)
      $err = "*Maximum 3 characters";
    else if(!preg_match($pattern, $percentile))
      $err = "*Incorrect percentile";
    return $err; 
  }
}