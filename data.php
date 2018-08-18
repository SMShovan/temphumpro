<?php
$host = "localhost";
$user = "logger";
$password = "password";
$database = "temperatures";

$con = mysql_connect($host,$user,$password);

mysql_select_db($database,$con);
$sql="select * from temperaturedata where date(dateandtime) = curdate() ORDER BY dateandtime DESC";
$temperatures = mysql_query($sql);

$sql1="select MAX(temperature) as max FROM  temperaturedata WHERE date(dateandtime)=curdate()";
$maxtemp = mysql_query($sql1);

$sql2="SELECT MIN(temperature) as min FROM temperaturedata WHERE date(dateandtime)=curdate()";
$mintemp = mysql_query($sql2);

         $temperature=mysql_fetch_assoc($temperatures); 
	 $mxt = mysql_fetch_assoc($maxtemp);
	 $mnt = mysql_fetch_assoc($mintemp);

        echo'<div align=right>';
		echo "Last Update"."</br>". $temperature['dateandtime']."</br>";
	echo '</div>';
	echo '<div class="info" align=center>';
                echo "Temperature ". $temperature['temperature']." Degree Celsius"."(";
                echo  $mxt['max']." /".$mnt['min'].")";
	        echo "Humidity ".$temperature['humidity']." Percent";
        echo '</div>';
?>
