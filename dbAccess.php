<?

	$query;
	$cmd = $_GET["cmd"];
	if ( $cmd == null )
		echo "error: null command";
	else {
		if ( $cmd == "add" ) {
			$id = $_GET["id"];
			$day = $_GET["day"];
			$query = "INSERT INTO hci VALUES('". $id ."', 0, 0)";
		}
		
		else if ( $cmd == "delete" ) {
			$id = $_GET["id"];
			$query = "DELETE FROM hci WEHRE id='". $id ."'";
		}
		
		else if ( $cmd == "getList" ) {
			$day = $_GET["day"];
			$query = "SELECT * FROM hci WHERE day='". $day ."'";
		}	
		echo $query."<br />";
		$dbLink = mysqli_connect('localhost', 'root', 'pdlwp88qja', 'hci') or die('db die');
		$queryResult = mysqli_query($dbLink, $query) or die("Error: ".mysqli_error($dbLink));
		if( !isset($queryResult) ) {
			die("Database query failed");
		}
		else {
			$row = mysqli_fetch_row($queryResult);
			echo implode($row);
		}
		/*
		else {
			
			echo $queryResult;
		}*/
			
		mysqli_close($dbLink);
	}
	
?>