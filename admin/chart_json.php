<?php include('config/db.php'); 

	//1get_sale 
	if ($_GET["data"] =="get_byqty") {
		$sql = "SELECT bookId, count(bookId) as times_borrowed FROM borrow GROUP BY bookId ORDER BY times_borrowed DESC";
		$result = $conn->prepare($sql);
		$result->execute();
		$sale = [];
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$mydate[] = array($row["id"],$row["bookId"],$row["studentid"],$row["borrowDate"],$row["returnDate"],$row["status"],$row["remark"]);
		}
		echo json_encode($mydate);
	}


?>