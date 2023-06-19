<?php

////##### 1. use the server setup current time and time zone
//$timezoneobj=date_default_timezone_get();
//$timezoneout=date("Y-m-d H:i:s");
//$time =date("H:i:s");
//$dateout=date("Y-m-d");


//#### 2. use the current time in Australia/Brisbane
//#### use DateTimeZone;  //MUST include
//#### use DateTime;  //MUST include
$timezone = new DateTimeZone('Australia/Brisbane');  //DateTime and DateTimeZone object
$current_date = new DateTime('now', $timezone);
$time =$current_date->format("H:i:s");
$dateout=$current_date->format("Y-m-d");
$timezoneout=$timezone->getName();//get timezone name


////#### 3. use the time "2023-03-31 12:40:57" in America/New_York
//$dateobj=date_create("2023-03-31 12:40:57",timezone_open('America/New_York'));
//$timezoneobj=date_timezone_get($dateobj);
//$timezoneout=timezone_name_get($timezoneobj);
//$time =date_format($dateobj,"H:i:s");
//$dateout=date_format($dateobj,"d/m/Y");

?>