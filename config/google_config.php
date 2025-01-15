<?php
require_once 'vendor/autoload.php';

$clientID = '1088442100618-o9s506q57rlig1h82pbh1fc9o4669ht5.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'https://shop.beggarscorporation.com/login';

$google_client=new Google_Client();

$google_client->setClientId($clientID);

$google_client->setClientSecret($clientSecret);

$google_client->setRedirectUri($redirectUri);

$google_client->addScope('email');

$google_client->addScope('profile');

?>