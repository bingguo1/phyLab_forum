<?php
    
  include 'header.php';
  session_start();
  unset($_SESSION['signed_in']);
  

  echo "<h4> So,what do you want to do now ?</h4>";
  echo "<a href='signin.php'> sign in </a> or go to <a href='index_cat.php'> forum homepage.</a> ";
  include 'footer.php';


?>

