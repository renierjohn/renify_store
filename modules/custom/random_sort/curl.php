<?php

$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://instagram-facebook-media-downloader.p.rapidapi.com/api?fburl=https://www.facebook.com/131845827426219/photos/a.132614174016051/647427149201415/?type=3&theater",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		"x-rapidapi-host: instagram-facebook-media-downloader.p.rapidapi.com",
		"x-rapidapi-key: 7e59376464msh97ea2adb515f0c4p12cc2ajsn3947212ee00a"
	),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}


{"sucess":true,"igurl":"https://instagram.fcgk12-1.fna.fbcdn.net/v/t50.2886-16/55416859_1387882458021060_5854
388449942962176_n.mp4?_nc_ht=instagram.fcgk12-1.fna.fbcdn.net&_nc_cat=100&oe=5D9D001F&oh=ade8e8ca65ce88536092937a7ad849d6","type":"2","error":null}