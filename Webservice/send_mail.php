<?php
require_once "../Webservice/configuration.php";
$From_Address = "noreply@example.com";
$ToAlert = "example@example.com";

class Send_Mail
{
    public function Send_Mail_Base ($To, $CC, $BCC, $Subject, $Message)
    {
        $Headers = "From: " .Settings_Mail::$From. "\n";
        if ($CC != "")
            $Headers .= "Cc: {$CC}\n";
        if ($BCC != "")
            $Headers .= "Bcc: {$BCC}\n";
        $Headers .= "X-Mailer: Money Manager EX - Usage Stats\n";
        
        //Send mail as HTML
        $Headers .= "MIME-Version: 1.0\n";
        $Headers .= "Content-Type: text/html; charset=utf-8\n";
        
        //Send mail
        mail($To, $Subject, $Message, $Headers);
    }
    
    public function OnError ($ErrorMessage)
    {
        global $ToAlert;
        Send_Mail::Send_Mail_Base (Settings_Mail::$ToAlert, "", "", "Usage stats webservice error", $ErrorMessage);
    }
}
?>