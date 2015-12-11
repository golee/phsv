<?
	$g_link = false;
	
	function GetMyConnection()
	{
		global $g_link;
		if( $g_link )
			return $g_link;
		$g_link = mysql_connect( 'host.name', 'user', 'password') or die('Could not connect to server.' );
		mysql_select_db('database_name', $g_link) or die('Could not select database.');
		return $g_link;
	}
	
	function CleanUpDB()
    	{
		global $g_link;
		if( $g_link != false )
			mysql_close($g_link);
		$g_link = false;
	}
	
?>