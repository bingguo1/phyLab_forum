<?php

include 'connect.php';
include 'header.php';
include 'bar.php';
if(!isset($_SESSION['signed_in']) or $_SESSION['signed_in']==false)
{
    echo " you have not logged in, please log in first before you try to post a message.";
}
else
{
    if($_SERVER['REQUEST_METHOD']!='POST')
    {
        echo "<form method='post' action=''>";
        echo "REPLY: <br> <textarea name='post_content' rows='5' cols='80'> </textarea> <br>
                <input type='submit'> ";
        echo "</form>";
    }
    else
    {  
      
        $sql="INSERT INTO    posts(post_content,post_date,post_topic,post_by)
              VALUES        ('".mysql_real_escape_string($_POST['post_content'])."',NOW(),'".$_GET['id']."','".$_SESSION['user_id']."')";
        $result=mysql_query($sql);
       
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "go back to the <a href='index_post.php?id=".$_GET['id']."'> topic</a>";
    }

}

include 'footer.php';




?>