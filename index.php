<?

	$dbName = "hci";
	$id = $_GET["id"];
	if ( $id == null )
		echo "error";
	else {
		$dbLink = mysqli_connect('localhost', 'root', 'pdlwp88qja', $dbName) or die('db die');
		// $query = "update hci set isChecked=true where id=" + $id;
		$query = "UPDATE hci SET isChecked=1 WHERE id='" . $id . "'";
		if ( $queryResult = mysqli_query($dbLink, $query) ) {
			echo $id." is Checked ". $queryResult; 
		}
		else {
			echo "query failed ". mysqli_error($dblink);
		}
			mysqli_close($dbLink);
	}
	
?>