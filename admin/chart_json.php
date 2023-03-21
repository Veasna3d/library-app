<?php include('config/db.php'); 

	if ($_GET["data"] =="get_byqty") {
		$sql = "SELECT * FROM vborrowByCategory";
		$result = $conn->prepare($sql);
		$result->execute();
		$sale = [];
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		  $mydate[] = array($row["bookId"],$row["times_borrowed"]);
		}
		echo json_encode($mydate);
	  }
	

?>