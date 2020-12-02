<?php

	require "libs/api.php";
	require "libs/classes.php";

	$api = new payAPI();

	$response = null;

	$request = new IsTransactionConfirmedRequest();

	$request->TransactionId = "K1FLV3M7SL3VJ60LRCUX";
	$request->TransactionKey = "TR0P895V89753ZN6Q07RT6DY5C3UUAQXT9MVX104O6I40L6MVZ";
	
	$response = $api->IsTransactionConfirmed($publicKey, $request);

	print_r($response);

	if(!$api->checkHash($response))
	{
		throw new Exception('Response is malformed/manipulated.');
	}


return;
	$request = new CreateTransactionRequest();
	
	$request->Amount = 1000;
	$request->Currency = "btc";
	$request->PriceCurrency = "eur";
	$request->IPN = "NO_IPN";
	$request->BlockAddress ="true";
	
	$response = $api->CreateTransaction($publicKey, $request);
	
	if(!$api->checkHash($response))
	{
		throw new Exception('Response is malformed/manipulated.');
	}

	$request = new GetTransactionDetailsRequest();

	$request->TransactionId = "K1FLV3M7SL3VJ60LRCUX";
	$request->TransactionKey = "TR0P895V89753ZN6Q07RT6DY5C3UUAQXT9MVX104O6I40L6MVZ";

	//$response = $api->GetTransactionDetails($publicKey, $request);	

	if(!$api->checkHash($response))
	{
		throw new Exception('Response is malformed/manipulated.');
	}

	$request = new ReOpenTransactionRequest();

	$request->TransactionId = "K1FLV3M7SL3VJ60LRCUX";
	$request->TransactionKey = "TR0P895V89753ZN6Q07RT6DY5C3UUAQXT9MVX104O6I40L6MVZ";

	//$response = $api->ReOpenTransaction($publicKey, $request);	

	if(!$api->checkHash($response))
	{
		throw new Exception('Response is malformed/manipulated.');
	}

	$request = new CancelTransactionRequest();

	$request->TransactionId = "K1FLV3M7SL3VJ60LRCUX";
	$request->TransactionKey = "TR0P895V89753ZN6Q07RT6DY5C3UUAQXT9MVX104O6I40L6MVZ";
	//Note if the customer has canceled the transaction
	$request->ByCustomer = "false";

	//$response = $api->CancelTransaction($publicKey, $request);	

	if(!$api->checkHash($response))
	{
		throw new Exception('Response is malformed/manipulated.');
	}


?>