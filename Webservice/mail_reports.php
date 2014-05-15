<?php
require_once "../Webservice/send_mail.php";
require_once "../Webservice/utility.php";


if (isset($_GET["MailTo"]) && isset($_GET["ReportName"]) && isset($_GET["Filters"]))
{
    if (!empty($_GET["MailTo"]) && !empty($_GET["ReportName"]))
        {
            //Assign variables
            $MailTo     = $_GET["MailTo"];
            $ReportName = $_GET["ReportName"];
            if (!empty($_GET["Filters"]))
                $Filters = $_GET["Filters"];
            else
                $Filters = "";
            
            //Format dates
            $VarToday = Settings_Report::$VariableToday;
            $VarAnd = Settings_Report::$VariableAnd;
            while (substr_count($Filters, $VarToday) > 0)
            {
                $OccurencePos = strpos($Filters, $VarToday);
                if ($OccurencePos > 0)
                {
                    if (strpos($Filters,"$VarAnd",$OccurencePos) > 0)
                        $OccurenceEnd = strpos ($Filters,"$VarAnd",$OccurencePos);
                    else
                        $OccurenceEnd = strlen ($Filters);
                    $Operator = substr ($Filters, $OccurencePos + strlen($VarToday), 1);
                    $Days = substr ($Filters, $OccurencePos + 1 + strlen($VarToday), $OccurenceEnd - $OccurencePos - 1 - strlen($VarToday));
                    if ($Operator == "-")
                        $Date = date ("Y-m-d", strtotime ("-${Days} days"));
                    else
                        $Date = date ("Y-m-d");
                    $Filters = substr_replace ($Filters, $Date, $OccurencePos, $OccurenceEnd - $OccurencePos);
                }
            }
            
            //Replace "&" sign
            $Filters = str_replace($VarAnd,"&",$Filters);
            
            //Create URL
            $URL = Settings_Report::$BaseURL;
            $URL .= "?execute_mode=EXECUTE&target_format=PDF";
            $URL .= "&project=".Settings_Report::$ProjectName;
            $URL .= "&project_password=".Settings_Report::$ProjectPassword;
            $URL .= "&xmlin=${ReportName}.xml";
            if ($Filters <> "")
                $URL .= "&".$Filters;
            
            echo "<a href='${URL}'>${URL}</a><br><br>";
            
            $Time = str_replace(".","",microtime(true));
            $FilePath = "../Temp/${ReportName}_${Time}.pdf";
            
            if (ManageFile::DownloadFile($URL,$FilePath))
            {
                $URL = str_replace("&project_password=".Settings_Report::$ProjectPassword,"",$URL);
                if (Send_Mail::ReportPDF($MailTo,$ReportName,$URL,$FilePath))
                    echo "Mail sent successfully";
                if (file_exists($FilePath))
                    unlink ($FilePath);
            }
        }
    else
    {
        echo ("Required parameter empty");
        $Message = "Required parameter empty:"."<br>";
        foreach ($_GET as $Key => $Value)
        {
            $Message .= $Key." = '${Value}'";
            $Message .= "<br>";
        }
        $Message .= "<br>"."<br>"."Server data:"."<br>";
        foreach ($_SERVER as $Key => $Value)
        {
            $Message .= $Key." = '${Value}'";
            $Message .= "<br>";
        }
            
        Send_Mail::OnError($Message);
    }
}
else
{
    echo ("Required parameter missing");
}
?>