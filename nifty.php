<?php

$url = "https://searchcaster.xyz/api/profiles?bio=gregskril";
//  Initiate curl
$ch = curl_init();
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
// Execute
$result=curl_exec($ch);
// Closing
curl_close($ch);

// Will dump a beauty json :3
$array = json_decode($result, true);

$address = $array[0]["connectedAddress"];

$url2 = "https://api.opensea.io/api/v1/assets?order_direction=desc&format=json&limit=20&include_orders=false&owner=".$address;

//  Initiate curl
$ch2 = curl_init();
// Will return the response, if false it print the response
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch2, CURLOPT_URL,$url2);
// Execute
$result2=curl_exec($ch2);
// Closing
curl_close($ch2);

$array2 = json_decode($result2, true);

print_r($array2["assets"][0]["image_thumbnail_url"]);
?>