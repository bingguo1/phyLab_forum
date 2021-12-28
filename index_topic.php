<?php
include 'header.php';
include 'connect.php';
include 'bar.php';
//// $result->num_rows , doesn't work, could due to 1 of the 2 reasons, 1, it works for mysql, but not for sqlite3, 2, your $result is from PDO, but num_rows should be used by MySQLi Object-oriented 
///// $result->fetch_assoc() doesn't work too

$sql="SELECT count(*) FROM  topics WHERE topic_cat=".$_GET['id'];

$_SESSION['cat_id']=$_GET['id'];

echo "<h3> <a href='create_topic.php'> create a topic </a> </h3>";
echo "<h3> <a href='index_cat.php'> back to categories list </a> </h3>";

//$result= mysql_query($sql);
$result=$conn->query($sql);


if(!$result)
  {
     echo "could no be displayed";
  }

else 
 {  


     $_SESSION['cat_id']=$_GET['id'];

     $nRows = $result->fetchColumn();
    if($nRows==0)
    {
        echo "there are no topics in this section yet, please create the first one!";
    }
    else
    {

        $sql="SELECT  topic_id,
              topic_subject,
              topic_by
    FROM 
              topics
    WHERE topic_cat=".$_GET['id'];
        
        $result=$conn->query($sql);
        
        echo '<table>';
         echo     '<tr>';
         echo         '<th>  TOPIC list </th>';
         echo         '<th>  CREATED by  </th>';
         echo     '</tr>';
 
         foreach($result as $row)
         {
                    echo   '<tr>';
                    echo     '<td>';
                    echo       '<a href="index_post.php?id='.$row['topic_id'].'"> '.$row['topic_subject'].' </a>';
                    echo     '</td>';

                    $sql2="
                                SELECT user_name
                                FROM    users
                                WHERE   user_id=".$row['topic_by'];
                    //                    $result2=mysql_query($sql2);
                    //                    $row2=mysql_fetch_assoc($result2);
                    $result2=$conn->query($sql2);
                    $row2=$result2->fetch();
                    echo     '<td>';
                    echo      $row2['user_name'];
                    
                    echo     '</td>';
                    echo   '</tr>';
               
         }

        echo '</table>';
    }
}

$conn=null;
include 'footer.php';

?>
