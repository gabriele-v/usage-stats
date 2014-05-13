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
    public static $From = "noreply@example.com";
    public static $ToAlert = "example@example.com";
}

class Settings_Report
{
    public static $Base_URL = "http:\\example.com";
}