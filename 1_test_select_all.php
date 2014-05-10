<?php
require_once "DB_Connection/db_connection.php";

$conn = connect_db();
$results = $conn -> query("SELECT * FROM Main_Stats ORDER BY ID DESC;");
$resultarray = array();
if($results !== false)
    {$resultarray = $results->fetchall(PDO::FETCH_ASSOC);}
$conn = null;

echo "<table border=1 cellpadding=5>";
    echo "<tr>";
        echo "<td>"."ID"."</td>";
        echo "<td>"."User_ID"."</td>";
        echo "<td>"."Version"."</td>";
        echo "<td>"."Platform"."</td>";
        echo "<td>"."OperatingSystem"."</td>";
        echo "<td>"."Language"."</td>";
        echo "<td>"."Country"."</td>";
        echo "<td>"."Resolution"."</td>";
        echo "<td>"."Start_Time"."</td>";
        echo "<td>"."End_Time"."</td>";
    echo "</tr>";
    for ($i = 0; $i <= sizeof($resultarray); $i++)
        {
            if (isset($resultarray[$i]["ID"]))
                {
                    echo "<tr>";
                        echo "<td>".$resultarray[$i]["ID"]."</td>";
                        echo "<td>".$resultarray[$i]["User_ID"]."</td>";
                        echo "<td>".$resultarray[$i]["Version"]."</td>";
                        echo "<td>".$resultarray[$i]["Platform"]."</td>";
                        echo "<td>".$resultarray[$i]["OperatingSystem"]."</td>";
                        echo "<td>".$resultarray[$i]["Language"]."</td>";
                        echo "<td>".$resultarray[$i]["Country"]."</td>";
                        echo "<td>".$resultarray[$i]["Resolution"]."</td>";
                        echo "<td>".$resultarray[$i]["Start_Time"]."</td>";
                        echo "<td>".$resultarray[$i]["End_Time"]."</td>";
                    echo "</tr>";
                }
        }
echo "</table>";
?>