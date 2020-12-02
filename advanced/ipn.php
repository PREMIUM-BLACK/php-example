<?php
	require "../libs/api.php";
	require "../libs/classes.php";
	
	$txid = $_GET["txid"];
	
	$api = new payAPI();
	
	
	//Get your transaction details by txid from your database
	$tx = null;
	
	$request = new GetTransactionDetailsRequest();

	$request->TransactionId = $txid;
	
	//Get the transaction key from your database
	$request->TransactionKey = tx->txkey;
		
	$details = $api->GetTransactionDetails($publicKey, $request);	
		
	if(!$api->checkHash($details))
	{
		throw new Exception('Response is malformed/manipulated.');
	}
		
	if($details->Error != null)
	{
		throw new Exception($details->Error);
	}
	
	switch($details->Status)
	{
		case "confirmed":
		
		
			break;
		
		case "timeout":
		
		
			break;
		
		case "waitingforbalance":
		
		
			break;
		
		case "waitingforconfirmation":
		
		
			break;
		
		
	}
	
	



?>