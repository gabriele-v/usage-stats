<?php
require_once "../Webservice/configuration.php";
require_once "../Webservice/send_mail.php";

class DB_Connect
{
    public function connect()
    {
        try
        {
            $conn = new PDO("mysql:host=" .Settings_Database::$Host. ";dbname=" .Settings_Database::$DbName,
                    Settings_Database::$Username, Settings_Database::$Password,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
        }
        catch (PDOException $e)
        {
            $Error = $e->getMessage ();
            Send_Mail::OnError($Error);
            echo $Error;
        }
            
        return $conn;
    }
}

class DB_Insert
{
    public function insert_main_stats ($User_ID, $Version, $Platform, $OperatingSystem,
                                        $Language, $Country, $Resolution, $Start_Time, $End_Time)
    {
    $conn = DB_Connect::connect();
    $statement = $conn->prepare ("INSERT INTO Main_Stats
                                (User_ID, Version, Platform, OperatingSystem,
                                Language, Country, Resolution, Start_Time, End_Time, Created_at)
                                VALUES
                                (:User_ID, :Version, :Platform, :OperatingSystem,
                                :Language, :Country, :Resolution, :Start_Time, :End_Time, UTC_TIMESTAMP());"
                                );
    $statement->bindParam (":User_ID", $User_ID);
    $statement->bindParam (":Version", $Version);
    $statement->bindParam (":Platform", $Platform);
    $statement->bindParam (":OperatingSystem", $OperatingSystem);
    $statement->bindParam (":Language", $Language);
    $statement->bindParam (":Country", $Country);
    $statement->bindParam (":Resolution", $Resolution);
    $statement->bindParam (":Start_Time", $Start_Time);
    $statement->bindParam (":End_Time", $End_Time);
    
    try
        {
            $statement->execute ();
            echo ("Record inserted");
        }
        catch (Exception $e)
        {
            $Error = $e->getMessage ();
            Send_Mail::OnError($Error);
            echo $Error;
        }
    
    $conn = null;
    }
}
?>