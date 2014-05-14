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
        {
            echo "Mailer Error: " .$mail->ErrorInfo;
            return false;
        }
        else
            return true;
    }
    
    public function ReportPDF ($ToAddress, $ReportName, $URL, $FilePath)
    {
        $ReportName = str_replace("_"," ",$ReportName);
        
        $mail = new PHPMailer;
        $mail->From = Settings_Mail::$FromMail;
        $mail->FromName = Settings_Mail::$FromName;
        $mail->addAddress($ToAddress);
        
        $mail->WordWrap = 50;
        $mail->isHTML(true);
        $mail->Subject = $ReportName;
        if (file_exists($FilePath))
            $mail->addAttachment ($FilePath, "${ReportName}.pdf");
        
        $Body = "<h2>Money Manager EX - Usage stats:</h2><b>Report ${ReportName}</b><br><br>";
        $Body .= "Open it in Reportico <a href='${URL}'>HERE</a>";
        $mail->Body = $Body;
        
        if(!$mail->send())
        {
            echo "Mailer Error: " .$mail->ErrorInfo;
            return false;
        }
        else
            return true;
    }
}
?>