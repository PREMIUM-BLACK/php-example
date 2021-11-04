<?php

require 'libs/config.php';
require 'libs/api.php';
require 'libs/classes.php';

$api = new payAPI($debugService);
// $api->setServiceUrl($serviceUrl);
$api->setPublicKey($privateKey);
$api->setPrivateKey($publicKey);

$response = null;

$request = new IsTransactionConfirmedRequest();

$request->TransactionId = 'K1FLV3M7SL3VJ60LRCUX';
$request->TransactionKey = 'TR0P895V89753ZN6Q07RT6DY5C3UUAQXT9MVX104O6I40L6MVZ';

$response = $api->IsTransactionConfirmed($request);

print_r($response);

if (!$api->checkHash($response))
{
    throw new Exception('Response is malformed/manipulated.');
}

return;

$request = new CreateTransactionRequest();

$request->Amount = 1000;
$request->Currency = 'btc';
$request->PriceCurrency = 'eur';
$request->IPN = 'NO_IPN';
$request->BlockAddress = 'true';

//Add custom User Id for accounting
$request->CustomUserId = '1234';

//Add custom Order Id for accounting
$request->CustomOrderId = '24';

//Add customer mail address for accounting
$request->CustomerMail = 'me@mail.com';

//Anything else you want to link with this transaction
$request->CustomData = '186ebff2-b319-49ed-a18f-dcbb27c9e9dd';

$response = $api->CreateTransaction($request);

if (!$api->checkHash($response))
{
    throw new Exception('Response is malformed/manipulated.');
}

$request = new GetTransactionDetailsRequest();

$request->TransactionId = 'K1FLV3M7SL3VJ60LRCUX';
$request->TransactionKey = 'TR0P895V89753ZN6Q07RT6DY5C3UUAQXT9MVX104O6I40L6MVZ';

//$response = $api->GetTransactionDetails($request);	

if (!$api->checkHash($response))
{
    throw new Exception('Response is malformed/manipulated.');
}

$request = new ReOpenTransactionRequest();

$request->TransactionId = 'K1FLV3M7SL3VJ60LRCUX';
$request->TransactionKey = 'TR0P895V89753ZN6Q07RT6DY5C3UUAQXT9MVX104O6I40L6MVZ';

//$response = $api->ReOpenTransaction($request);	

if (!$api->checkHash($response))
{
    throw new Exception('Response is malformed/manipulated.');
}

$request = new CancelTransactionRequest();

$request->TransactionId = 'K1FLV3M7SL3VJ60LRCUX';
$request->TransactionKey = 'TR0P895V89753ZN6Q07RT6DY5C3UUAQXT9MVX104O6I40L6MVZ';
//Note if the customer has canceled the transaction
$request->ByCustomer = 'false';

//$response = $api->CancelTransaction($request);	

if (!$api->checkHash($response))
{
    throw new Exception('Response is malformed/manipulated.');
}
