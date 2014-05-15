<?php

######################################
##      Configuration settings      ##
##           don't touch            ##
######################################

class Settings_Database
{
    public static $Host = "localhost";
    public static $DbName = "MMEX_Stats";
    public static $Username = "mysql";
    public static $Password = "mysql";
}

class Settings_Mail
{
    public static $FromMail = "noreply@example.com";
    public static $FromName = "Example";
    public static $ToAlert = "example@example.com";
}

class Settings_Report
{
    public static $BaseURL = "http://example.com/Reports/run.php";
    public static $ProjectName = "Project";
    public static $ProjectPassword = "Password";
    public static $VariableToday = "!TODAY!";
    public static $VariableAnd = "!AND!";
}