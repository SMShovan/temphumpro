<?php
header('Content-Type: application/json');

$host = "localhost";
$user = "logger";
$password = "password";
$database = "temperatures";

$hours = 24;

$con = mysql_connect($host,$user,$password);
mysql_select_db($database,$con);

$sql="SELECT * FROM temperaturedata WHERE dateandtime >= (NOW() - INTERVAL $hours HOUR)";

$temperatures = mysql_query($sql); 

$data = array();

while($row=mysql_fetch_assoc($temperatures))
{
	$data[]=$row;
}


print json_encode($data); 

