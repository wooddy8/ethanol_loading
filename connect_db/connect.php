<?php 
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "loading";

// Connect  Mysql
$connect = @mysql_connect($host,$user,$pass);
// UTF 8
mysql_query("SET NAMES 'utf8'",$connect);

//Select database
mysql_select_db($dbname) or die ("Error !! Cannot select database");

// hidden show waring report
error_reporting(0);
?>