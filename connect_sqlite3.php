<?php
	$dbFile = '/Users/bing/learn/web/bgDatabase.db';
	try {	    
	    $conn = new PDO("sqlite:$dbFile");
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //	    echo "Connected successfully";
	} catch(PDOException $e) {
	   echo "Connection failed: " . $e->getMessage();
	}
?>
