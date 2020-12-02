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
	
$response = $api->CreateTransaction($publicKey, $request);
	
if(!$api->checkHash($response))
{
  throw new Exception('Response is malformed/manipulated.');
}

echo $response->Url;

?>
```
