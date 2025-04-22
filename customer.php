<?php

include('connect.php');

$scan_url = 'HTTPS://L4E.US/589/1001/ATTENDEE-1001/DEMO-1001/DEMOCOMPANY';
$scan_data = explode('/', $scan_url);

echo 'URL: '.$scan_url;

echo '<pre>';
print_r($scan_data);
echo '</pre>';

$event_id = $scan_data[3];
$badge_id = $scan_data[4];
$first_name = $scan_data[6];
$last_name = $scan_data[5];
$company = $scan_data[7];

echo 'Event ID: '.$event_id.'
    <br>
    Badge ID: '.$badge_id.'
    <br>
    First Name: '.$first_name.'
    <br>
    Last Name: '.$last_name.'
    <br>
    Company: '.$company;

$api_url = 'https://developer.experientswap.com/APIv1/LeadInfo'.
    '?apikey='.MARITZ_API_KEY.
    '&actcode='.MARITZ_ACTIVATION_CODE.
    '&badgeid=0'.
    '&connectkey='.$badge_id.
    '&lastinitial='.$last_name[0];

echo 'URL: '.$api_url;

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => $api_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $response = json_decode($response, true);
    echo '<pre>';
    print_r($response);
    echo '</pre>';
}
