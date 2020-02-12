<?php
 $host="localhost";
 $uname="root";
 $pass="";
 $database = "mycms";
 $connection=mysql_connect($host,$uname,$pass) 
 or die("Database Connection Failed");
 
 $result=mysql_select_db($database)
 or die("database cannot be selected");
 
?>