<?php
$From_Address = "noreply@example.com";
$ToAlert = "example@example.com";

class Send_Mail
{
    public function Send_Mail_Base ($To, $CC, $BCC, $Subject, $Message)
    {
        global $From_Address;
        $Headers = "";
        
        // To send HTML mail, the Content-type header must be set
        //$Headers .= "MIME-Version: 1.0" . "\r\n";
        //$Headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        
        // Additional headers
        $Headers .= "From: ${From_Address}" . "\r\n";
        if ($CC != "")
            $Headers .= "Cc: ${CC}" . "\r\n";
        if ($BCC != "")
            $Headers .= "Bcc: ${BCC}" . "\r\n";
        
        //Send mail
        mail($To, $Subject, $Message, $Headers);
    }
    
    public function OnError ($ErrorMessage)
    {
        global $ToAlert;
        Send_Mail::Send_Mail_Base ($ToAlert, "", "", "Usage stats webservice error", $ErrorMessage);
    }
}
?>