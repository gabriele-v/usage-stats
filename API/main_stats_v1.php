<?php
require_once "../Webservice/db_functions.php";
require_once "../Webservice/send_mail.php";
require_once "../Webservice/utility.php";

function getIpAddress()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];
    else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($ips[count($ips) - 1]);
        }
    else
        return $_SERVER['REMOTE_ADDR'];
}

if (
    isset($_GET["User_ID"]) && isset($_GET["Version"])
    && isset($_GET["Platform"]) && isset($_GET["OperatingSystem"])
    && isset($_GET["Language"]) && isset($_GET["Country"]) && isset($_GET["Resolution"])
    && isset($_GET["Start_Time"]) && isset($_GET["End_Time"])
    )
    
    {
        if (
        !empty($_GET["User_ID"]) && !empty($_GET["Version"])
        && !empty($_GET["Platform"]) && !empty($_GET["OperatingSystem"])
        && !empty($_GET["Language"]) && /*!empty($_GET["Country"]) && */ !empty($_GET["Resolution"])
        && !empty($_GET["Start_Time"]) && !empty($_GET["End_Time"])
        )
            {
            $User_ID            = $_GET["User_ID"];
            $Version            = $_GET["Version"];
            $Platform           = $_GET["Platform"];
            $OperatingSystem    = $_GET["OperatingSystem"];
            $Language           = $_GET["Language"];
            if ($_GET["Country"] != "")
                $Country        = $_GET["Country"];
            else
                $Country        = Localize::getLocationInfoByIp(getIpAddress());
            $Resolution         = $_GET["Resolution"];
            $Start_Time         = date ($_GET["Start_Time"]);
            $End_Time           = date ($_GET["End_Time"]);
            
            DB_Insert::insert_main_stats($User_ID, $Version, $Platform, $OperatingSystem,
                                            $Language, $Country, $Resolution, $Start_Time, $End_Time);
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