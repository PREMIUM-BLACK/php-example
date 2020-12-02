# php-example
Our API used by basic PHP example.


## Basic Example

```
<?php
	
require "libs/api.php";
require "libs/classes.php";

$api = new payAPI();

$response = null;

$request = new CreateTransactionRequest();
	
$request->Amount = 1000;
$request->Currency = "btc";
$request->PriceCurrency = "eur";
$request->IPN = "NO_IPN";
$request->BlockAddress ="true";
$request->ReturnQRCode = "true";

//Add custom User Id for accounting
$request->CustomUserId = "1234";

//Add custom Order Id for accounting
$request->CustomOrderId = "24";

//Add customer mail address for accounting
$request->CustomerMail = "me@mail.com";

//Anything else you want to link with this transaction
$request->CustomData = "186ebff2-b319-49ed-a18f-dcbb27c9e9dd";
	
$response = $api->CreateTransaction($publicKey, $request);
	
if(!$api->checkHash($response))
{
  throw new Exception('Response is malformed/manipulated.');
}

echo $response->Url;

?>
```
