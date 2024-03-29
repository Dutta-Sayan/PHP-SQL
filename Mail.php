<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


//Load Composer's autoloader
require 'vendor/autoload.php';

/**
 * Class for sending email for password resetting.
 */
class Mail {
  public string $email;
    public function __construct($email) {
        $this->email = $email;
    }

    public function resetPasswordEmail($token) {
      $newEmail = new PHPMailer();
      try {
          $newEmail->isSMTP();
          $newEmail->Host = 'smtp.gmail.com';
          $newEmail->SMTPAuth = true;
          // Email address from which mail is to be send.
          $newEmail->Username = 'sayandutta0587@gmail.com';
          $newEmail->Password = 'yyojcrmqcluoqpyz';
          $newEmail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $newEmail->Port = 587;
          $newEmail->setFrom('sayandutta0587@gmail.com','Sayan');
          // Contains the user's email address to which mail is to be sent.
          $newEmail->addAddress($this->email);
          $newEmail->addReplyTo('sayandutta0587@gmail.com','Sayan');
          $newEmail->isHTML(true);
          $newEmail->Subject = 'Reset Password';
          $newEmail->Body = <<<END
          Click  <a href="sql3.com/sendLink.php?token=$token">here</a>for resetting password.
          END;
          $newEmail->send();
          
      }
      catch (Exception $e) {
          echo 'The email cannot be sent'.$newEmail->ErrorInfo;
      }
  }
}

