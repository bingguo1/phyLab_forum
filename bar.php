<?php

if(!isset($_SESSION['signed_in']) or ($_SESSION['signed_in']==false))
   {
       
       echo 'You have not signed in,please <a href="signin.php">sign in</a> or <a href="signup.php"> create an account</a>.';
   }
else
{  
    
        echo 'Hello <div id="bar_name"> '.$_SESSION['user_name'].'.</div>';
        echo '<div id="bar_signout"> Not you?<a href="signout.php"> sign out </a> </div>';
    
}


?>
