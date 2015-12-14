<?

	$query;
	$cmd = $_GET["cmd"];
	if ( $cmd == null )
		echo "error: null command";
	else {
		if ( $cmd == "add" ) {
			$id = $_GET["id"];
			$day = $_GET["day"];
			$icon = $_GET["icon"];
			$query = "INSERT INTO hci (id, isChecked, day, icon) VALUES('". $id ."', 0, ".$day.",". $icon .")";
		}
		
		else if ( $cmd == "delete" ) {
			$id = $_GET["id"];
			$query = "DELETE FROM hci WHERE id='". $id ."'";
		}
		
		else if ( $cmd == "getList" ) {
			$query = "SELECT * FROM hci WHERE 1";
		}
		else if ( $cmd == "fix" ) {
			$id = $_GET["id"];
			$query = "UPDATE hci SET isChecked=1 WHERE id='" . $id . "'";
		}
		else if ( $cmd == "modify" ) {
			$id = $_GET["id"];
			$newId = $_GET["newId"];
			//$query = "UPDATE hci SET isChecked=1 WHERE id='" . $id . "'";
		}
		else if ( $cmd == "important" ) {
			$id = $_GET["id"];
			$isImportant = $_GET["isImportant"];
			$id = $_GET["id"];
			$impVal;
			if ( $isImportant == "true" )
				$impVal = 0;
			else
				$impVal = 1;
			$query = "UPDATE hci SET isImportant=". $impVal ." WHERE id='" . $id . "'";
		}
		
		$dbLink = mysqli_connect('localhost', 'root', 'pdlwp88qja', 'hci') or die('db die');
		mysqli_set_charset($dbLink, 'utf8');
		$queryResult = mysqli_query($dbLink, $query) or die("Error: ".mysqli_error($dbLink) . $query);
		$arrayResult = array();
		if ( is_bool($queryResult) )	// add, delete
			array_push($arrayResult, var_export($queryResult, true));
		else
			while( $result = mysqli_fetch_array($queryResult) ) {
				array_push( $arrayResult, $result );
			} 
		$responseData = array(
			'query' => $query,
			'cmd' => $cmd,
			'row' => mysqli_affected_rows($dbLink),
			'result' => $arrayResult 
			);
		echo json_encode($responseData);
		
		mysqli_close($dbLink);
	}
	
?>