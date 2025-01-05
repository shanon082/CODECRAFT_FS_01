<?php
require 'db.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $otp = rand(100000, 999999);  // Generate a 6-digit OTP
        session_start();
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

        // Email setup
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.example.com';  // Use your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'your_email@example.com';  // Your email
            $mail->Password = 'your_email_password';  // Your password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('your_email@example.com', 'YourAppName');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Your OTP for Password Recovery';
            $mail->Body = "Your OTP is: <strong>$otp</strong>";

            $mail->send();
            echo "OTP sent to your email. <a href='verify_otp.html'>Verify OTP</a>";
        } catch (Exception $e) {
            echo "Error sending OTP: {$mail->ErrorInfo}";
        }
    } else {
        echo "Email not found.";
    }
}
?>
