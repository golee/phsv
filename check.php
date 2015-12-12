<?

	$dbName = "hci";
	$id = $_GET["id"];
	$cmd = $_GET["cmd"];
	if ( $cmd == null )
		echo "error: null command";
	else {
		if ( $cmd == "check" ) {	// Red button check`
			$query = "SELECT * FROM hci WHERE day=". date(w);
		}
		else if ( $cmd == "recognize" ) {	// Check only one item
			$query = "UPDATE hci SET isChecked=1 WHERE id='" . $id . "'";
		}
		$dbLink = mysqli_connect('localhost', 'root', 'pdlwp88qja', $dbName) or die('db die');
		// $query = "update hci set isChecked=true where id=" + $id;
		
		if ( $queryResult = mysqli_query($dbLink, $query) ) {
			echo $id." is Checked ". $queryResult; 
		}
		else {
				echo "query failed ". mysqli_error($dblink);
		}
			mysqli_close($dbLink);
	}
	
?>