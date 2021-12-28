<?php
    
include 'header.php';
include 'connect.php';
include 'bar.php';

$sql=" SELECT cat_id,cat_name,cat_description
       FROM   categories";
//$result=mysql_query($sql);
$result=$conn->query($sql);


echo "<table>";
//    while($row=mysql_fetch_assoc($result))
foreach($result as $row)
{
    echo  "<tr>";
    echo     "<td>";
    echo       "<a href='index_topic.php?id=".$row['cat_id']."'> ".$row['cat_name']."</a>";
    echo     "</td>";
    echo     "<td>";
    echo        $row['cat_description'];
    echo     "</td>";
    echo  "</tr>";
}
echo "</table>";


$conn = null;




?>

