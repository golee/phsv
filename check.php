<?
	include 'gcm/sendMessage.php';
	$query;
	$id;
	$cmd = $_GET["cmd"];
	$today = date(w)-1;
	if ( $today === -1 )
		$today = 6;
	
	if ( $cmd == null )
		echo "error: null command";
	else {
		if ( $cmd == "check" ) {	// Red button check`
			$query = "SELECT * FROM hci WHERE day=". $today;
			// needs to send message
		}
		else if ( $cmd == "recognize" ) {	// Check only one item
			$id = $_GET["id"];
			$query = "UPDATE hci SET isChecked=1 WHERE id='" . $id . "' AND day=". $today;
		}
		$dbLink = mysqli_connect('localhost', 'root', 'pdlwp88qja', 'hci') or die('db die');
		mysqli_set_charset($dbLink, 'utf8');
		$queryResult = mysqli_query($dbLink, $query) or die("Error: ".mysqli_error($dbLink) . $query);
		echo "Query: ". $query ."<br>";
		if ( is_bool($queryResult) ) {
			if ( mysqli_affected_rows($dbLink) === 0 )
				echo $id. ": affected row:0";
			else
				echo $id." is Checked ". $queryResult; 
		}
		else {
			if ( $cmd == "check" ) {
				$arrayResult = array();
				while($result = mysqli_fetch_array( $queryResult )) {
					array_push( $arrayResult, $result );
				} 
				$isFullyPacked = false;
				$unpackedItems = array();
				foreach ( $arrayResult as $value ) {
					if ( !$value["isChecked"] ) {
						array_push($unpackedItems, $value[id]);
					}
				}
				if ( sizeof($unpackedItems) === 0 )	// fully packed
					sendMessage("모든 물건을 챙겼습니다."); 
				else {	// not packed
					$message = "";
					foreach ( $unpackedItems as $itemName )
						$message .= "(". $itemName .") ";
					$message .= " 를 빠뜨리셨습니다.";
					sendMessage( $message );
				}
			}
			else
				echo "<br>something worng</br>";
		}
		mysqli_close($dbLink);
	}
	
?>