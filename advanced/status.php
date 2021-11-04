<?php
require '../libs/api.php';
require '../libs/classes.php';

$txid = $_GET['txid'];
$txkey = $_GET['txkey'];


GetDetails($txid, $txkey);

function GetDetails(string $txid, string $txkey)
{
    require 'libs/config.php';

    $api = new payAPI($debugService);
    // $api->setServiceUrl($serviceUrl);
    $api->setPublicKey($privateKey);
    $api->setPrivateKey($publicKey);

    $request = new GetTransactionDetailsRequest();

    $request->TransactionId = $txid;
    $request->TransactionKey = $txkey;
    $request->ReturnQRCode = 'true';

    $response = $api->GetTransactionDetails($request);

    // if(!$api->checkHash($response))
    // {
    // throw new Exception('Response is malformed/manipulated.');
    // }

    if ($response->Error != null)
    {
        throw new Exception($response->Error);
    }


?>

    <span>Please sent the amount of <?= $response->Amount ?> BTC</span><br />
    <br />
    <span>to the address <?= $response->AddressToReceive ?><br />
        <br />
        <img src="<?= $response->QRCode ?>" />
        <br />
        <br />
        <span>Your current status is: <?= $response->Status ?>



        <?php

    }





        ?>