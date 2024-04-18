<?php

use Fpdf\Fpdf;

require_once realpath(__DIR__ . "/vendor/autoload.php");
use Dotenv\Dotenv;$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

/**
 * This class validates the input given by user.
 */
class User {

  /**
   * @var string $fname
   *  Stores the first name.
   */
  public string $fname;

  /**
   * @var string $lname
   *  Stores the last name.
   */
  public string $lname;

  /**
   * @var string $mobNo
   *  Stores the mobile number.
   */
  public string $mobNo;

  /**
   * @var string $email
   *  Stores the email address.
   */
  public string $email;

  /**
   * Constructor to initialise the class variables.
   *
   * @param string $fname
   *  Contains the first name.
   *
   * @param string $lname
   *  Contains the last name.
   *
   * @param string $mobNo
   *  Contains the mobile number.
   *
   * @param string $email
   *  Contains the email address.
   */
  public function __construct($fname, $lname, $mobNo, $email) {
    $this->fname = $fname;
    $this->lname = $lname;
    $this->mobNo = $mobNo;
    $this->email = $email;
  }

  /**
   * Checks if the first and last name matches the proper naming convention.
   *
   * @return string
   *  Returns name field value on wrong input and on correct input returns
   *  the full name.
   */
  public function isValid(): string {

    // Pattern for checking first name and last name.
    $pattern = "/^[a-zA-Z ]{1,25}$/";

    // Error in first name or last name returns the first name or last name 
    // respectively.
    if (!preg_match($pattern, $this->fname))
      return $this->fname;
    else if (!preg_match($pattern, $this->lname))
      return $this->lname;
    else {
      // On valid name, the first and last name are concatenated and returned.
      $greetings = $this->fname . " " . $this->lname;
      return $greetings;
    }
  }

  /**
   * The function stores the image submitted by user in 'uploads' folder.
   * 
   * @return string
   *  Returns the target address of stored image on successful upload.
   */
  public function isValidImage(): string {

    // Storing the target directory name.
    $targetDir = "./uploads/";
    // Contatenating  the target directory to the image file name to get the 
    // full path where the image will be stored.
    $target = $targetDir . basename($_FILES['image']['name']);
    // Storing the temporary file name of the image.
    $tempFileName = $_FILES['image']['tmp_name'];
    $imageFileType = strtolower(pathinfo($target, PATHINFO_EXTENSION));
    // Checking for correct image extension type.
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
      return "";
    }
    // The path is returned if the image is uploaded successfully.
    if (move_uploaded_file($tempFileName, $target)) {
      return $target;
    }
    // Returning null on failure in image upload.
    else
      return "";
  }

  /**
   * Checks if the number is valid or not.
   * The number must be an Indian mobile number.
   * 
   * @return bool|string
   *  Returns 1 in case of invalid number and the number as string if valid.
   */
  public function isValidNumber(): mixed {

    // Checking for proper mobile number pattern.
    if (!preg_match("/^(\+91)[0-9]{10}$/", $this->mobNo)) {
      return 1;
    }
    else {
      return $this->mobNo;
    }
  }

  /**
   * Checks the validity of the email syntax and also if the email is correct.
   * 
   * @return bool 
   *  Returns 0 on invalid syntax and 1 on correct email.
   */
  public function isValidEmail(): bool {

    // If email syntax is incorrect, returns 0.
    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      return 0;
    }
    else {
      // Stores the api key.
      $api_key = $_ENV['API_KEY'];
      // Initialising curl session.
      $ch = curl_init();
      // Settings the options to include when connecting with the api.
      curl_setopt_array($ch, [
        CURLOPT_URL => "https://emailvalidation.abstractapi.com/v1/?api_key=$api_key&email=$this->email",
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_FOLLOWLOCATION => TRUE
      ]);
      // Establishing connection with the api using the above option values.
      $result = curl_exec($ch);
      curl_close($ch);

      // Decoding the json data obtained from the api execution.
      $data = json_decode($result, TRUE);
      // Checking if the email is deliverable or not.
      if ($data['deliverability'] === "DELIVERABLE")
        return 1;
      else
        return 0;
    }
  }

  /**
   * Takes the marks input and breaks it down and stores in an array.
   * Each array value contains two fields (subject, marks).
   * 
   * @return bool|array
   *  'res' containing each subject's name and marks on valid entry
   *  and 0 on invalid entry.
   */
  public function processMarks($marks): mixed {

    // Pattern for checking the valid entry of marks.
    $pattern = "/^[ ]*[a-zA-Z]+[ ]{0,1}[a-zA-Z]*[|][0-9]{1,3}[ ]*$/";
    $marks = preg_replace("/[ ]{2,}/", "\n", $marks);

    // String to array conversion on the basis of new lines.
    $marksArr = explode("\n", $marks);
    // Checking for each Subject|Marks pattern
    for ($i = 0; $i < count($marksArr); $i++) {
      $marksArr[$i] = trim($marksArr[$i]);
      if (!preg_match($pattern, $marksArr[$i])) {
        return 0;
      }
    }
    // Stores the Subject|Marks as an array.
    $res = array();
    $j = 0;
    foreach ($marksArr as $i) {
      $res[$j] = explode("|", $i);
      $j++;
    }
    // Regex pattern for subject.
    $subPattern = "/[a-zA-Z]{1,10}/";
    // Regex pattern for marks.
    $marksPattern = "/[0-9]{1,3}/";
    foreach ($res as $i) {
      if (!preg_match($subPattern, $i[0]) || !preg_match($marksPattern, $i[1])) {
        return 0;
      }
    }
    return $res;
  }

  /**
   * Creates an html table from the marks input.
   * The table contains two columns containing subject name and marks.
   * 
   * @param array $marksArr 
   *  Contains the array of subject name and marks.
   * 
   * @return string 
   *  String containing the html table.
   */
  public function createTable(string $marksArr): mixed {

    if (count($marksArr) > 0) {
      $table = '<h3>Your Result</h3><br><table class="Result">';
      $table .= '<tr><th>' . "Subject" . '</th>' . '<th>' . "Marks" . '</th></tr>';
      foreach ($marksArr as $subjectrow) {
        $table .= '<tr>';
        foreach ($subjectrow as $res) {
          $table .= '<td>' . $res . '</td>';
        }
        $table .= '</tr>';
      }
      $table .= '</table>';
    }
    return $table;
  }

  /**
   * Using FPDF package to create a pdf file of the information 
   * submitted by user.
   * 
   * It creates two copies, one is stored on the server and the other is 
   * downloaded in the client's machine.
   * 
   * Pdf document will only be created after successful validation 
   * of all the inputs.
   * 
   * @param array $marksArr
   *  Contains the 2D array consisting of subject and marks.
   * 
   * @param string $imgPath
   *  Contains the path of the image
   */
  public function createPdf(array $marksArr, string $imgPath) {

    // Stores the Fpdf object.
    $pdf = new Fpdf();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 18);
    $pdf->Cell(0, 10, "USER DETAILS", 0, 1, 'C');
    // Generating the image in pdf using the image path.
    $pdf->Image("$imgPath");
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, "Name: $this->fname $this->lname", 0, 1, 'L');
    $pdf->Cell(0, 10, "Mobile No.: $this->mobNo", 0, 1, 'L');
    $pdf->Cell(0, 10, "Email: $this->email", 0, 1, 'L');
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(80, 10, "SUBJECT", 1, 0, 'C');
    $pdf->Cell(80, 10, "MARKS", 1, 1, 'C');
    $pdf->SetFont('Arial', 'B', 11);
    // Adding the subject and the respective marks in the form of table in pdf.
    for ($i = 0; $i < count($marksArr); $i++) {
      for ($j = 0; $j < count($marksArr[$i]); $j++) {
        $pdf->Cell(80, 10, $marksArr[$i][$j], 1, 0, 'C');
      }
      $pdf->Ln();
    }
    $pdf->Output();
    $pdf->Output('./uploads/details.pdf', 'F');
  }
}
