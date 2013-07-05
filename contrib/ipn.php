<?php

$BIPS = $_POST;

$secret = "My-IPN-secret";
$hash = hash('sha512', $BIPS['transaction']['hash'] . $secret);
if ($BIPS['hash'] != $hash ) {
	header('HTTP/1.1 400 Not like that!');
	die();
}

if ($BIPS['status'] != 1 || !isset($BIPS['custom']['uid'])) {

	// @todo respond to case when the status is something unexpected (not 1)
	//       or the payload isn't what you expect it to be. In this example
	//       I expect to get a user id.

	header('HTTP/1.1 200 OK');
	die();
}

$userId   = $BIPS['custom']['uid'];
$amount   = $BIPS['fiat']['amount'];
$currency = $BIPS['fiat']['currency'];
$bipsId   = $BIPS['invoice'];

try {

	// @todo store or otherwise handle the transaction here...

	header('HTTP/1.1 200 OK');
} catch(Exception $e) {

	header('HTTP/1.1 500 Oh shit!');
}
