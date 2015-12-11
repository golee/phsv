<?

	$dbName = "hci";
	$id = $_GET["id"];
	if ( $id == null )
		echo "error";
	else {
		echo "Success<br>";
		echo "id: " . $id  . "<br>";
	
		$dbLink = mysqli_connect('localhost', 'root', 'pdlwp88qja', $dbName) or die('db die');
		// $query = "update hci set isChecked=true where id=" + $id;
		$query = "INSERT into hci VALUES('" . $id . "', 0)";
		if ( $queryResult = mysqli_query($dbLink, $query) ) {
			mysqli_close($dbLink);
			echo $queryResult; 
		}
		else
			echo "query failed";
	}
	
?>