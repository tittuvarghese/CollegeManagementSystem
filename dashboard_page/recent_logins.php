<?php
$RecentLogins = mysql_query("SELECT * FROM `log_login` WHERE userid='{$UserAuthData['userid']}' ORDER BY id DESC LIMIT 5");
while($row = mysql_fetch_array($RecentLogins))
{
	$date = strtotime($row['timestamp']);
	$date = date("F j, Y, g:i A",$date);
	echo '<tr>';
         echo '<td>'.$row['ip'].'</td>';
         echo '<td>'.$row['os'].'</td>';
         echo '<td>'.$row['browser'].'</td>';
         echo '<td>'.$date.'</td>';
    echo '</tr>';
}
?>