<?php

$transaction = $_GET['tx'];
$action = $_GET['action'];

if ($transaction == null | $action == null)
{
	echo 'Invalid data';
	return;
}

echo "Transaction: $transaction";
echo "<br />Action: $action";
