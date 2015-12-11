<?
	$serverKey = 'AIzaSyCtxTkAPKiSKGOGehDxt97Z8zI7EqrHp6A';
	$url = 'https://gcm-http.googleapis.com/gcm/send';
	$headers = array(
            'Content-Type:application/json',
            'Authorization:key='.$serverKey
            );
	$data = array('data' => array('title'=>"title", "message" => "okokJebum"),
		'to' => 'el53otEAakg:APA91bFmS6qDdHWVz4nAkKMG9Cd_dOzZV1wSxu9zWPt2NhcQsr-93WvGPnVoML8wgLfOUfxRKsTPGVXbwjfgD6sE8Wh86tjDzJVk34AkzYVsb6Y3_tNQ3uJLawx8sFHyo3HDPHKeD6J9');
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
?>