<?php

use Guzzle\Http\StaticClient as Guzzle;

require_once __DIR__ . '/../vendor/autoload.php';

$listUrl = 'http://www.localeplanet.com/api/codelist.json';
$infoUrl = 'http://www.localeplanet.com/api/%s/info.json';
$buildJson = __DIR__ . '/../resources/locales.json';

$ret = array();

$response = Guzzle::get($listUrl);
$locales = json_decode($response->getBody(true), true);

// loop through all locales and load info
foreach ($locales as $locale) {
    $response = Guzzle::get(sprintf($infoUrl, $locale));
    $info = json_decode($response->getBody(true), true);

    $ret[str_replace('-', '_', $locale)] = $info;
}

file_put_contents($buildJson, json_encode($ret));
