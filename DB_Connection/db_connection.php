<?php
######################################
##     DB configuration settings    ##
##         don't touch              ##
######################################

function connect_db()
{
    $db_host = "localhost";
    $db_name = "MMEX_Stats";
    $db_user = "mysql";
    $db_password = "mysql";

    try
        {
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name",
                    $db_user, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
        }
        catch (PDOException $e)
        {echo $e->getMessage();}
        
    return $conn;
}
?>