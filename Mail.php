<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

/**
 * Class for sending email for password resetting.
 */
class Mail {

  /**
   * Stores the email to sent the forgot password link to.
   *
   * @var string
   */
  public string $email;

  /**
   * Initialises the email.
   *
   * @param string $email
   *  Contains the email address to sent link to.
   */
  public function __construct(string $email) {
    $this->email = $email;
  }

  /**
   * Function to send reset password link to supplied email address.
   *
   * @param string $token
   *  Contains the token value
   * 
   * @return mixed
   *  Returns 1 on succesfully sending the mail.
   *  Returns error message if mail sending is unsuccessful.
   */
  public function resetPasswordEmail(string $token): mixed {
    // Storing the object of PHPMailer class.
    $newEmail = new PHPMailer();
    try {
      $newEmail->isSMTP();
      // Set the SMTP server through which mail is to be sent.
      $newEmail->Host = 'smtp.gmail.com';
      $newEmail->SMTPAuth = TRUE;
      // Username from which mail is to be send.
      $newEmail->Username = 'sayandutta0587@gmail.com';
      // SMTP Password.
      $newEmail->Password = 'yyojcrmqcluoqpyz';
      // TLS Encryption is enabled.
      $newEmail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      // TCP port used for connection .
      $newEmail->Port = 587;
      // Mail from which reset email is to be sent. 
      $newEmail->setFrom('sayandutta0587@gmail.com', 'Sayan');
      // Contains the user's email address to which mail is to be sent.
      $newEmail->addAddress($this->email);
      $newEmail->addReplyTo('sayandutta0587@gmail.com', 'Sayan');
      // Html email format.
      $newEmail->isHTML(TRUE);
      $newEmail->Subject = 'Reset Password';
      $newEmail->Body = <<<END
          Click  <a href="sql3.com/sendLink.php?token=$token">here</a>for resetting password.
          END;
      $newEmail->send();
      // Return 1 on successfully sending the mail.
      return 1;
      
    }
    catch (Exception $e) {
      $msg = 'The email cannot be sent' . $newEmail->ErrorInfo;
      return $msg;
    }
  }
}

