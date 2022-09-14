<?php 

	$servername = "localhost";
<<<<<<< HEAD
	$database = "lib_db";
=======
	$database = "library_db";
>>>>>>> 939382cc7d4e03ac6333ded8ea2f106ef9e53bbf
	$username = "root";
	$password = "";

	try{
		$conn = new PDO("mysql:host=$servername;dbname=$database",$username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		//echo "Conncetion successfully!";
	}
	catch(PDOException $e)
	{
		echo "Connection failed" . $e->getMessage();
	}

 ?>