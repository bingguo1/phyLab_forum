<?php
//connect.php
$server	= 'bingguo.db.11794775.hostedresource.com';
$username	= 'bingguo';
$password	= 'Mysql0105!';
$database	= 'bingguo';

if(!mysql_connect($server, $username,  $password))
{
 	exit('Error: could not establish database connection');
}
if(!mysql_select_db($database))
{
 	exit('Error: could not select the database');
}
?>	