<link rel="stylesheet" href="style.css" data-n-g="">

<h2>Top NFTs owned by Farcasters</h2>
<?php

$servername = "mysql.domain.com";
$username = "nftuser";
$password = "Testing123!!";
 
// Connection
$conn = new mysqli($servername,
           $username, $password);
 
$users = array("dwr", "v", "ace", "les", "giacaglia");

$url = "https://searchcaster.xyz/api/profiles?bio=".$users[0];
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

// Fake it for now


foreach($array2["assets"] as $item) {
	echo "<img width='100' src='".$item["collection"]["image_url"]."' /><br />";
	$slug = $item["collection"]["slug"];
	echo "<a href='".$item["permalink"]."' target='_blank'>".$item["asset_contract"]["name"]."</a><br />";
	$price = (int)$item["last_sale"]["total_price"];
	$decimals = (int)$item["last_sale"]["payment_token"]["decimals"];
	
	$url3 = "https://api.opensea.io/api/v1/collection/".$slug."/stats?format=json";
	
	//  Initiate curl
	$ch3 = curl_init();
	// Will return the response, if false it print the response
	curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
	// Set the url
	curl_setopt($ch3, CURLOPT_URL,$url3);
	// Execute
	$result3=curl_exec($ch3);
	// Closing
	curl_close($ch3);

	$array3 = json_decode($result3, true);
	echo "Floor: ".$array3["stats"]["floor_price"]."<br />";
	$value = $price/pow(10,$decimals);
	if ($value > 0) { 
		echo "Purchased for: ".$item["last_sale"]["payment_token"]["symbol"]." ".$value;
		
	}
	echo "<br /><br />";
}

?>