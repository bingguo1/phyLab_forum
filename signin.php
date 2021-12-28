<?php    
    include 'header.php';
    include 'connect.php';

    if($_SERVER['REQUEST_METHOD']!='POST' )
    {
        echo 'Donot have an account? <a href="signup.php"> sign up </a> here';
        echo '<div id="signin_form">';
        echo 'SIGN  IN';
        
        echo '<form method="post" action="">
           username:<input type="text" name="user_name" /> <br>
           password:<input type="password" name="user_pass" /> <br>
           <input type="submit" value="Sign in" />
           </form>';
        echo '</div>';
    }
    else 
    {
        

        $match=FALSE; //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++



        $errors=''; //++++++++++++++++++++++++++++++++++++++++++++++++++++++


        if(empty($_POST['user_name']))
        {
            $errors='The username field must not be empty. <br>';
        }
        if(empty($_POST['user_pass']))
        {
            $errors=$errors.'The password field must not be empty.';
        }
        
        if(empty($errors))

        {
            $stmt = $conn->prepare("SELECT user_id, user_name,user_level
                                FROM users WHERE user_name=? AND user_pass=?");
            $stmt->execute([$_POST['user_name'], sha1($_POST['user_pass'])]);
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$result)
            {
                $errors='something went wrong while signing in, please try again later.';

            }
            else
            {
                
                $match=TRUE; //++++++++++++++++++++++++++++++++++++++++++
                
                $_SESSION['signed_in']=TRUE;
                $_SESSION['user_id']=$result['user_id'];
                $_SESSION['user_name']=$result['user_name'];
                $_SESSION['user_level']=$result['user_level'];                  
                echo 'welcome, ' .$_SESSION['user_name'].'.<a href="index_cat.php"> Proceed to the forum index page </a>.';

            }
        }
        ///////////////////////////////////////////////////////////////////

        if($match==FALSE)
        {
              echo 'Donot have an account? <a href="signup.php"> sign up </a> here';
        echo '<div id="signin_form">';
        echo 'SIGN  IN';
        
        echo '<form method="post" action="">
           username:<input type="text" name="user_name" /> <br>
           password:<input type="password" name="user_pass" /> <br>
           <input type="submit" value="Sign in" />
           </form>';
        echo '</div>';
              echo " <div id='error'>".$errors."</div>" ;
        }
        ///////////////////////////////////////////////////////////////////
        
    }
    include 'footer.php';
?>
