<?php
//signup.php
include 'connect.php';
include 'header.php';





if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    /*the form hasn't been posted yet, display it
	  note that the action="" will cause the form to post to the same page it is on */

    echo "Already have an account? <a href='signin.php'>sign in </a> here.";
    echo '<div id="signup_form">';
    echo '<b> CREATE AN ACCOUNT:</b>';
    echo '<form method="post" action="">
 	 	Username: <input type="text" name="user_name" /> <br>
 		Password: <input type="password" name="user_pass"> <br>
		Password again: <input type="password" name="user_pass_check"> <br>
		E-mail: <input type="email" name="user_email">  <br>
 		<input type="submit" value="SUBMIT" /><br>
 	 </form>';
     echo '</div>';
}
else
{
    /* so, the form has been posted, we'll process the data in three steps:
		1.	Check the data
		2.	Let the user refill the wrong fields (if necessary)
		3.	Save the data 
	*/
	$errors ='';
	
	if(!empty($_POST['user_name']))
	{
		//the user name exists
		if(!ctype_alnum($_POST['user_name']))
		{
			$errors= 'The username can only contain letters and digits.<br>';
		}
		if(strlen($_POST['user_name']) > 30)
		{
			$errors= $errors.'The username cannot be longer than 30 characters.<br>';
		}
	}
	else
	{
		$errors= 'The username field must not be empty.<br>';
	}
	
    if (!empty($_POST['user_email']))
    {
        if((!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$_POST['user_email'])))
        $errors=$errors."wrong email format.<br>";
    }
    else
    {
        $errors=$errors."The email field must not be empty.<br>";
    }
	
	if(!empty($_POST['user_pass']))
	{
		if($_POST['user_pass'] != $_POST['user_pass_check'])
		{
			$errors = $errors.'The two passwords did not match.';
		}
	}
	else
	{
		$errors = $errors.'The password field cannot be empty.';
	}
	
	if(empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
	
	{
		//the form has been posted without, so save it
		//notice the use of mysql_real_escape_string, keep everything safe!
		//also notice the sha1 function which hashes the password
		$sql = "INSERT INTO
					users(user_name, user_pass, user_email ,user_date, user_level)
				VALUES('" . mysql_real_escape_string($_POST['user_name']) . "',
					   '" . sha1($_POST['user_pass']) . "',
					   '" . mysql_real_escape_string($_POST['user_email']) . "',
						NOW(),
						0)";
						
		$result = mysql_query($sql);
		if(!$result)
		{
			//something went wrong, display the error
			echo 'Something went wrong while registering. Please try again later.';
			//echo mysql_error(); //debugging purposes, uncomment when needed
		}
		else
		{
			echo 'Successfully registered. You can now <a href="signin.php">sign in</a> and start posting! :-)';
		}
	}

    else
    {
        echo "Already have an account? <a href='signin.php'>sign in </a> here.";
    echo '<div id="signup_form">';
    echo '<b> CREATE AN ACCOUNT:</b>';
    echo '<form method="post" action="">
 	 	Username: <input type="text" name="user_name" /> <br>
 		Password: <input type="password" name="user_pass"> <br>
		Password again: <input type="password" name="user_pass_check"> <br>
		E-mail: <input type="email" name="user_email">  <br>
 		<input type="submit" value="SUBMIT" /><br>
 	 </form>';
     echo '</div>';
        echo " <div id='error'>".$errors."</div>" ;
        
    }

}

include 'footer.php';
?>