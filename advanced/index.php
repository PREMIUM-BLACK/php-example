<?php

	require "../libs/api.php";
	require "../libs/classes.php";

	
	
	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["txtValue"]) && $_POST["txtValue"]!=null && isset($_POST["bnSubmit"]))
	{
		create();
	}
	
	 
	
	function create()
	{
		global $publicKey;	
		
		$amount = floatval($_POST["txtValue"]);
		
		if($amount <= 0)
			return;
		
		$api = new payAPI();

		$response = null;


		$request = new CreateTransactionRequest();
		
		$request->Amount = $amount;
		$request->Currency = "btc";
		$request->PriceCurrency = "eur";
		$request->IPN = "NO_IPN";
		$request->BlockAddress ="true";
		
		$response = $api->CreateTransaction($publicKey, $request);
		
		print_r($response);
		
		// if(!$api->checkHash($response))
		// {
			// throw new Exception('Response is malformed/manipulated.');
		// }

		if($response->Error !=null)
		{
			throw new Exception($response->Error);
		}
		
		header("Location: status.php?txid=" . $response->TransactionId . "&txkey=" . $response->TransactionKey);
		
	 }
	
?>



<form action="index.php" method="post">

<input type="text" name="txtValue" />

<input type="submit" name="bnSubmit" value="Send order" />

</form>