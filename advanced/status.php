<?php
	require "../libs/api.php";
	require "../libs/classes.php";
	
	$txid = $_GET["txid"];
	$txkey = $_GET["txkey"];
	
	
	GetDetails();
	
	function GetDetails()
	{
		global $publicKey;
		global $txid;
		global $txkey;
		
		$api = new payAPI();
		
		$request = new GetTransactionDetailsRequest();

		$request->TransactionId = $txid;
		$request->TransactionKey = $txkey;
		$request->ReturnQRCode = "true";
		
		$response = $api->GetTransactionDetails($publicKey, $request);	
		
		// if(!$api->checkHash($response))
		// {
			// throw new Exception('Response is malformed/manipulated.');
		// }
		
		if($response->Error != null)
		{
			throw new Exception($response->Error);
		}
	
		
		?>
		
		<span>Please sent the amount of <?=$response->Amount ?> BTC</span><br />
		<br />
		<span>to the address <?= $response->AddressToReceive ?><br />
		<br />
		<img src="<?=$response->QRCode ?>" />
		<br />
		<br />
		<span>Your current status is: <?=$response->Status ?>
		
		
		
		<?php
		
	}





?>