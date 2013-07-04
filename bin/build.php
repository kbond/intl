<?php

use Guzzle\Http\StaticClient as Guzzle;

require_once __DIR__ . '/../vendor/autoload.php';

$listUrl = 'http://www.localeplanet.com/api/codelist.json';
$infoUrl = 'http://www.localeplanet.com/api/%s/info.json';
$resourceDir = __DIR__ . '/../resources/';

$ret = array();

$response = Guzzle::get($listUrl);
$locales = json_decode($response->getBody(true), true);

// loop through all locales and load info
foreach ($locales as $locale) {
    $response = Guzzle::get(sprintf($infoUrl, $locale));
    $info = json_decode($response->getBody(true), true);

    $ret[str_replace('-', '_', $locale)] = $info;
}

// create locals.json file
file_put_contents($resourceDir . 'locales.json', json_encode($ret));

// create locals.php file
$php = sprintf("<?php return %s;%s", var_export($ret, true), PHP_EOL);

file_put_contents($resourceDir . 'locales.php', $php);
