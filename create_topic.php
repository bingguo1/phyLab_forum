<?php    
include 'header.php';
include 'bar.php';
include 'connect.php';


echo '<h2>Create a topic</h2>';
if(!isset($_SESSION['signed_in']))
{
	//the user is not signed in
	echo 'Sorry, you have to <a href="signin.php">sign in</a> to create a topic.';
}
else
{
	//the user is signed in
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{	
		//the form hasn't been posted yet, display it
		//retrieve the categories from the database for use in the dropdown
		$sql = "SELECT
					cat_id,
					cat_name,
					cat_description
				FROM
					categories";
		
		$result = mysql_query($sql);
		
		if(!$result)
		{
			//the query failed, uh-oh :-(
			echo 'Error while selecting from database. Please try again later.';
		}
		else

			{
		
				echo '<form method="post" action="">
					Subject: <input type="text" name="topic_subject" size="80" /> <br>
					Category:'; 
                 
				
				echo '<select name="topic_cat">';
					while($row = mysql_fetch_assoc($result))
					{
						echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
					}
				echo '</select>';	
                echo '<br>';
					
				echo 'Message: <textarea  rows="5" cols="80" name="post_content" /></textarea>
					<input type="submit" value="Create topic" />
				 </form>';
			}
		}

else
	{
		//start the transaction



        $errors='';
        if(empty($_POST['topic_subject']))
        {
            $errors='The subject cannot be empty <br>';
        }
        if(empty($_POST['post_content']))
        {
            $errors=$errors.'The content cannot be empty <br>';
        }

		
		if(!empty($errors))
        {


            $sql = "SELECT
					cat_id,
					cat_name,
					cat_description
				FROM
					categories";
		
		    $result = mysql_query($sql);
            echo '<form method="post" action="">
					Subject: <input type="text" name="topic_subject" size="80" /> <br>
					Category:'; 
                 
				
				echo '<select name="topic_cat">';
					while($row = mysql_fetch_assoc($result))
					{
						echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
					}
				echo '</select>';	
                echo '<br>';
					
				echo 'Message: <textarea  rows="5" cols="80" name="post_content" /></textarea>
					<input type="submit" value="Create topic" />
				 </form>';


                 echo $errors;
        }
	else
    {
			//the form has been posted, so save it
			//insert the topic into the topics table first, then we'll save the post into the posts table
			$sql = "INSERT INTO 
						topics(topic_subject,
							   topic_date,
							   topic_cat,
							   topic_by)
				   VALUES('" . mysql_real_escape_string($_POST['topic_subject']) . "',
							   NOW(),
							   " .$_POST['topic_cat']. ",
							   " . $_SESSION['user_id'] . "
							   )";
					 
			$result = mysql_query($sql);
			if(!$result)
			{
				//something went wrong, display the error
				echo 'An error occured while inserting your data. Please try again later.' . mysql_error();
				
			}
			else
			{
				//the first query worked, now start the second, posts query
				//retrieve the id of the freshly created topic for usage in the posts query





				$topicid = mysql_insert_id(); //+++++++++++++++++++++++++++++++++++++++++++++++
				
				$sql = "INSERT INTO
							posts(post_content,
								  post_date,
								  post_topic,
								  post_by)
						VALUES
							('" . mysql_real_escape_string($_POST['post_content']) . "',
								  NOW(),
								  " . $topicid . ",
								  " . $_SESSION['user_id'] . "
							)";
				$result = mysql_query($sql);
				
				if(!$result)
				{
					//something went wrong, display the error
					echo 'An error occured while inserting your post. Please try again later.' . mysql_error();
					
				}
				else
				{
					
					
					//after a lot of work, the query succeeded!
					echo 'You have successfully created <a href="index_post.php?id='. $topicid . '">your new topic</a>.';
				}
			}
		}
   }
}

include 'footer.php';


?>

