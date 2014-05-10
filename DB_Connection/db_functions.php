<?php
require_once "db_connection.php";
require_once "../Utility/send_mail.php";

class DB_Insert
{
    public function insert_main_stats ($User_ID, $Version, $Platform, $OperatingSystem,
                                        $Language, $Country, $Resolution, $Start_Time, $End_Time)
    {
    $conn = connect_db();
    $statement = $conn->prepare ("INSERT INTO Main_Stats
                                (User_ID, Version, Platform, OperatingSystem,
                                Language, Country, Resolution, Start_Time, End_Time)
                                VALUES
                                (:User_ID, :Version, :Platform, :OperatingSystem,
                                :Language, :Country, :Resolution, :Start_Time, :End_Time);"
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