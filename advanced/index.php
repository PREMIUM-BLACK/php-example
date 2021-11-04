<?php

require '../libs/api.php';
require '../libs/classes.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['txtValue']) && $_POST['txtValue'] != null && isset($_POST['bnSubmit']))
{
    create();
}



function create()
{
    require '../libs/config.php';

    $amount = floatval($_POST['txtValue']);

    if ($amount <= 0)
        return;

    $api = new payAPI($debugService);
    // $api->setServiceUrl($serviceUrl);
    $api->setPublicKey($privateKey);
    $api->setPrivateKey($publicKey);

    $response = null;


    $request = new CreateTransactionRequest();

    $request->Amount = $amount;
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

    print_r($response);

    // if(!$api->checkHash($response))
    // {
    // throw new Exception('Response is malformed/manipulated.');
    // }

    if ($response->Error != null)
    {
        throw new Exception($response->Error);
    }

    header('Location: status.php?txid=' . $response->TransactionId . '&txkey=' . $response->TransactionKey);
}

?>

<form action="index.php" method="post">

    <input type="text" name="txtValue" />

    <input type="submit" name="bnSubmit" value="Send order" />

</form>