<?php
    
include 'connect.php';

include 'header.php';
include 'bar.php';
$_SESSION['topic_id']=$_GET['id'];
echo "<h2> <a href='create_post.php?id=".$_GET['id']."'> reply to this topic </a> </h2>";
echo "<h2> <a href='index_topic.php?id=".$_SESSION['cat_id']."'> back to topics list </a></h2>";

$sql="SELECT topic_subject
      FROM    topics
      WHERE   topic_id=".$_GET['id'];

//$result=mysql_query($sql);
//$subject=mysql_fetch_assoc($result);

$result=$conn->query($sql);
$subject=$result->fetch();
       
$sql="SELECT       post_content,post_date,post_by
      FROM         posts
      WHERE        post_topic=".$_GET['id'];
$result=$conn->query($sql);

echo "SUBJECT:".$subject['topic_subject'];
echo "<table>";
echo   "<tr id='post_tr_firstline'>";
echo      "<th> AUTHOR </th>";
echo      "<th> CONTENT </th>";
echo      "<th> POST TIME</th>";
echo   "</tr>";
foreach($result as $row)
{
    echo "<tr id='post_tr_otherlines'>";
    echo "<td>";
    $sql2="SELECT user_name 
           FROM   users
           where  user_id=".$row['post_by'];
    $result2=$conn->query($sql2);
    $row2=$result2->fetch();
    echo $row2['user_name'];
    echo "</td>";
    echo "<td>";
    echo $row['post_content'];
    echo "</td>";
    echo "<td>";
    echo $row['post_date'];
    echo "</td>";
}
$conn = null;
include 'footer.php';

?>
