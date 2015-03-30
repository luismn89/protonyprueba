<?php
	$jsondata = array();

	if ( isset($_POST['email_suscriptor']) ) {
		mail('info@uppersky.co', 'protony', utf8_decode($_POST['email_suscriptor']));
		$jsondata['status_send'] = 'ok';
		$jsondata['msj'] = 'Your message has been sent successfully!';
	} else {
		$jsondata['status_send'] = 'error';
		$jsondata['msj'] = 'ERROR! Your message could not be sent!';
		die();
	}
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($jsondata);
	exit();
?>