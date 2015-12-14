<?
	$token = $_GET["token"];
	if ( is_null($token) )
		;
	else
		setToken($token);
	
	function setToken ( $token ) {
		$query = "UPDATE gcmToken SET token='". $token ."' WHERE 1";
		$dbLink = mysqli_connect('localhost', 'root', 'pdlwp88qja', 'hci') or die('db die');
		mysqli_set_charset($dbLink, 'utf8');
		$queryResult = mysqli_query($dbLink, $query) or die("Error: ".mysqli_error($dbLink) . $query);
		echo "token inserted";
	}
	
	function getToken () {
		$query = "SELECT token FROM gcmToken WHERE 1";
		$dbLink = mysqli_connect('localhost', 'root', 'pdlwp88qja', 'hci') or die('db die');
		mysqli_set_charset($dbLink, 'utf8');
		$queryResult = mysqli_query($dbLink, $query) or die("Error: ".mysqli_error($dbLink) . $query);
		
		$arrayResult = array();
		while( $result = mysqli_fetch_array($queryResult) ) {
			array_push( $arrayResult, $result );
		}
		$token = $arrayResult[0]["token"];
		return $token;
	}
	function sendMessage( $message, $cmd="nothing" ) {
		$serverKey = 'AIzaSyCtxTkAPKiSKGOGehDxt97Z8zI7EqrHp6A';
		$url = 'https://gcm-http.googleapis.com/gcm/send';
		$headers = array(
				'Content-Type:application/json',
				'Authorization:key='.$serverKey
				);
		$data = array('data' => array('title'=>"PackingHelper", "message" => $message, "cmd" => $cmd),
			'to' => getToken() );
		$data = json_encode($data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);		
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$output = curl_exec($ch);
		$info = curl_getinfo($ch);
		curl_close($ch);
		//echo implode(json_decode($output));
		echo implode($info);
		 $cnt = $obj->{"success"};
	}
?>