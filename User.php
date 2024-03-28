<?php

    use Fpdf\Fpdf;
    require('vendor/autoload.php');
    /**
     * This class validates the input given by user.
     * 
     * @param string: contains class variables fname and lname
     * 
     * @return object
     *  Returns the User class object.
     */
    class User {
        public string $fname, $lname, $mobNo, $email;

        /**
         * Class contructor which initializes the fname and lname variables.
         * 
         * @param string: first and last name are passed for initialization to class variables.
         */
        public function __construct($fname, $lname, $mobNo, $email) {
            $this->fname = $fname;
            $this->lname = $lname;
            $this->mobNo = $mobNo;
            $this->email = $email;
        }

        /**
         * Checks if the first and last name matches the proper naming convention or not
         * @return string returns naem field value on wrong input and on correct input returns the full name.
         */
        public function isValid() {
            $pattern = "/^[a-zA-Z ]{1,25}$/";
            if (!preg_match($pattern, $this->fname))
                return $this->fname;
            else if (!preg_match($pattern, $this->lname))
                return $this->lname;
            else {
                $greetings = $this->fname." ".$this->lname;
                return $greetings;
            }
        }

        /**
         * The function stores the image submitted by user in 'uploads' folder
         * It returns the target address of stored image on successful upload.
         * @return string
         */
        public function isValidImage() {
            $file = $_FILES["image"];
            $targetDir = "./uploads/";
            $target = $targetDir . basename($_FILES['image']['name']);
            $tempFileName = $_FILES['image']['tmp_name'];
            $imageFileType = strtolower(pathinfo($target, PATHINFO_EXTENSION));
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                return "";
            }
            if (move_uploaded_file($tempFileName, $target)) {
                return $target;       
            }
            else
                return "";
        }

        /**
         * Checks if the number is valid or not.
         * The number must be an Indian mobile number.
         * @return mixed returns 1 in case of invalid number and the number as string if valid.
         */
        public function isValidNumber() {
            if (!preg_match("/^(\+91)[0-9]{10}$/",$this->mobNo)) {
                return 1;
            }
            else {
                return $this->mobNo;
            }
        }

        /**
         * Checks the validity of the email syntax.
         * @return integer returns 0 on valid syntax and 1 on invalid syntax.
         */
        public function isValidEmail() {
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                return 0;
            }
            else{
                // return 1;
                $api_key = "038c427c27d1417397129856c0f90f04";
                $ch = curl_init();
                curl_setopt_array($ch,[
                    CURLOPT_URL => "https://emailvalidation.abstractapi.com/v1/?api_key=$api_key&email=$this->email",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true
                ]);
                $result = curl_exec($ch);
                curl_close($ch);

                $data = json_decode($result, true);
                if ($data['deliverability'] === "DELIVERABLE")
                    return 1;
                else
                    return 0;
            }
        }
        /**
         * Takes the marks input and breaks it down and stores in an array.
         * Each array value contains two fields (subject, marks).
         * @return mixed 'res' containing each subject's name and marks and 0 on invalid entry.
         */
        public function processMarks($marks) {
            // $marks = preg_replace('/[ ]{2,}/', '\n', $marks);
            $pattern = "/^[ ]*[a-zA-Z]+[ ]{0,1}[a-zA-Z]*[|][0-9]{1,3}[ ]*$/";
            $marks = preg_replace("/[ ]{2,}/", "\n", $marks);
            $marksArr = explode("\n", $marks);
            for ($i = 0; $i < count($marksArr); $i++) {
                $marksArr[$i] = trim($marksArr[$i]);
                if (!preg_match($pattern, $marksArr[$i])) {
                    return 0;
                }
            }
            $res = array();
            $j = 0;
            foreach ($marksArr as $i) {
                $res[$j] = explode("|", $i);
                $j++;
            }
            $subPattern = "/[a-zA-Z]{1,10}/";
            $marksPattern = "/[0-9]{1,3}/";
            foreach ($res as $i) {
                if (!preg_match ($subPattern, $i[0]) || !preg_match ($marksPattern, $i[1])) {
                    return 0;
                }
            }
            return $res;
        }

        /**
         * Creates an html table from the marks input.
         * The table contains two columns containing subject name and marks.
         * @param $marksArr contains the string of subject name and marks.
         * @return string containing the html table
         */
        public function createTable($marksArr) {
            if(count($marksArr) > 0) {
                $table = '<h3>Your Result</h3><br><table class="Result">';
                $table .= '<tr><th>'."Subject".'</th>'.'<th>'."Marks".'</th></tr>';
                foreach($marksArr as $subjectrow){
                    $table .= '<tr>';
                    foreach($subjectrow as $res){
                        $table .= '<td>'.$res.'</td>';
                    }
                    $table .= '</tr>';
                }
                $table .= '</table>';
            }
            return $table;
        }

        /**
         * Using FPDF package to create a pdf file of the information submitted by user.
         * It creates two copies, one is stored on the server and the other is downloaded in the client's machine.
         * Pdf document will only be created after successful validation of all the inputs
         * 
         * @param mixed 
         * $marksArr is used to access the 2D array consisting of subject and marks.
         * $imgPath contains the path of the image
         */
        public function createPdf($marksArr, $imgPath) {
            $pdf = new Fpdf();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->Cell(0,10,"USER DETAILS",0,1,'C');
            $pdf->Image("$imgPath");
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0,10,"Name: $this->fname $this->lname",0,1,'L');
            $pdf->Cell(0,10,"Mobile No.: $this->mobNo",0,1,'L');
            $pdf->Cell(0,10,"Email: $this->email",0,1,'L');
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(80,10,"SUBJECT",1,0,'C');
            $pdf->Cell(80,10,"MARKS",1,1,'C');
            $pdf->SetFont('Arial', 'B', 11);
            for ($i = 0; $i < count($marksArr); $i++) {
                for ($j = 0; $j < count($marksArr[$i]); $j++) {
                    $pdf->Cell(80,10, $marksArr[$i][$j],1,0,'C');
                }
                $pdf->Ln();
            }
            $pdf->Output();
            $pdf->Output('./uploads/details.pdf', 'F');
            
        }
    }
?>
