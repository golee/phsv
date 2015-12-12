<?

	$query;
	$cmd = $_GET["cmd"];
	if ( $cmd == null )
		echo "error: null command";
	else {
		if ( $cmd == "add" ) {
			$id = $_GET["id"];
			$day = $_GET["day"];
			$query = "INSERT INTO hci (id, isChecked, day) VALUES('". $id ."', 0, 0)";
		}
		
		else if ( $cmd == "delete" ) {
			$id = $_GET["id"];
			$query = "DELETE FROM hci WHERE id='". $id ."'";
		}
		
		else if ( $cmd == "getList" ) {
			$query = "SELECT * FROM hci WHERE 1";
		}
		
		$dbLink = mysqli_connect('localhost', 'root', 'pdlwp88qja', 'hci') or die('db die');
		mysqli_set_charset($dbLink, 'utf8');
		$queryResult = mysqli_query($dbLink, $query) or die("Error: ".mysqli_error($dbLink) . $query);
		$arr = array();
		if ( is_bool($queryResult) )
			array_push(var_export($queryResult, true));
		else
			while($result = mysqli_fetch_array( $queryResult )) {
				array_push( $arr, $result );
			} 
		$responseData = array(
			'query' => $query,
			'result' => $arr 
			);
		echo json_encode($responseData);
		
		mysqli_close($dbLink);
	}
	
?>