<?php

require_once __DIR__ . '/vendor/autoload.php';

use CloudFlarePurger\CloudFlarePurger;

//Token is generated from Cloud Flare user account
$token = '';
//ZoneID is the site you have access to clear caches on Cloud Flare
$zoneId = '';

$request = new CloudFlarePurger($token, $zoneId);

//Verify Token
$verifyToken = $request->verifyToken();

//Purge all
$purgeAll = $request->purgeAll();

// Purge Urls
$urls = [
    'https://example.com',
    'https://example.com/1'
];

$purgeUrls = $request->purgeUrls($urls);

//purge prefixes

$prefixes = [
    'https://example.com/prefix_1',
    'https://example.com/prefix_2'
];

$purgePrefixes = $request->purgePrefixes($prefixes);

