<?php
function get_uv($city){
	$date = date('Y-m-d H:i:s');
	$date = date(DATE_ISO8601, strtotime($date));
	$date = substr($date, 0, 16);
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://api.wunderground.com/api/e7e7d4b5c03f0b24/conditions/q/ZM/$city.json",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
	    "cache-control: no-cache",
	    "postman-token: 66087946-39f2-176d-0fa3-3f15bff06c43"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  return "cURL Error #:" . $err;
	} else {
	  $response = json_decode($response, true);
	  return $response['current_observation']['UV'];
	}
}

echo get_uv('Kitwe');

?>