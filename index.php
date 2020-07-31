<?php
	/**
	 * Created by Dmitrii Bykov.
	 * Site: https://DBykov.ru
	 * Date: 31.07.2020
	 * Time: 20:54
	 */

	require_once( "./vendor/autoload.php" );

	use GuzzleHttp\Client;

	$apiUrl="http://api.cpanomer1.affise.com";
	$apikey="e60a98867d363b0d43b9e7c58ec498ed";


	$client = new Client();

	$response = $client->request( "GET", "{$apiUrl}/3.0/partner/offers", [ "headers" => [ "API-Key" => $apikey ] ] );

	$offer    = json_decode( $response->getBody()->getContents(), true )["offers"][0];

	if(isset($offer["countries"])){
		echo "Список доступных стран:<br>";
		foreach ( $offer["countries"] as $country ) {
			echo $country . "<br>";
		}
	}


	$response2 = $client->request( "GET", "{$apiUrl}/3.0/stats/conversions?action_id=",[ "headers" => [ "API-Key" => $apikey ] ] );
	$conversion=json_decode($response2->getBody()->getContents(),true)["conversions"][0];


	if ($offer["id"] == $conversion["offer_id"])
	{
		echo "Найдена конверсия из " . $conversion["country"]." (".$conversion["country_name"]."), actionID = ".$conversion["action_id"];
	}