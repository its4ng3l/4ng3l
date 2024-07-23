<?php
$url = 'http://example.com'; //website url

$response = get_headers($url);
if ($response && strpos($response[0], '200')) {
    echo "Сайт доступен\n";
} else {
    echo "Сайт не доступен\n";
}

$blockedCountries = array('RU', 'CN', 'US');
$ip = gethostbyname(parse_url($url, PHP_URL_HOST));

$apiUrl = 'https://api.ipgeolocation.io/ipgeo?apiKey=YOUR_API_KEY&ip=' . $ip; //ipgeolocation api key need
$countryData = json_decode(file_get_contents($apiUrl));

if (in_array($countryData->country_code2, $blockedCountries)) {
    echo "Доступ запрещен для страны: " . $countryData->country_name . "\n";
} else {
    echo "Доступ разрешен\n";
}
?>
