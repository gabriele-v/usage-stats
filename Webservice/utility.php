<?php
class ManageFile
{
    public function DownloadFile ($URL,$FilePath)
    {
        $Length = 5120;
        
        $Handle = fopen($URL, "rb");
        $Write = fopen($FilePath, "w");
        
        while (!feof($Handle))
        {
            $Buffer = fread($Handle, $Length);
            fwrite($Write, $Buffer);
        }
        
        fclose($Handle);
        fclose($Write);
        
        return file_exists ($FilePath);
    }
}

class Localize
{
    public function getLocationInfoByIp ($IpAddress)
    {
        $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$IpAddress));    
        if($ip_data && $ip_data->geoplugin_countryName != null)
        {
            //$result["Country"] = $ip_data->geoplugin_countryName;
            //$result["City"] = $ip_data->geoplugin_city;
            $result = $ip_data->geoplugin_countryName;
        }
        return $result;
    }
}
?>