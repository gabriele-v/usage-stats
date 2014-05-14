<?php
require_once "../Webservice/configuration.php";
require "../3rd/PHPMailer/PHPMailerAutoload.php";

class Send_Mail
{
    public function OnError ($ErrorMessage)
    {
        $mail = new PHPMailer;
        $mail->From = Settings_Mail::$FromMail;
        $mail->FromName = Settings_Mail::$FromName;
        $mail->addAddress(Settings_Mail::$ToAlert);
        
        $mail->WordWrap = 50;
        $mail->isHTML(true);
        
        $mail->Subject = "Usage stats webservice error";
        $mail->Body    = $ErrorMessage;
        
        if(!$mail->send())
            echo "Mailer Error: " .$mail->ErrorInfo;
    }
}
?>