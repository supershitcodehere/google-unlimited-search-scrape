<?php
use koulab\google\GoogleCustomSearchEngineRequestParams;
use koulab\google\GoogleCustomSearchEngine;

require '../vendor/autoload.php';
$to = new GoogleCustomSearchEngine();
$params = new GoogleCustomSearchEngineRequestParams();
$to->setParams($params);

//https://cse.google.com/cse/all
$params->setCx('');
$params->setQuery('天気予報');
$params->setCseTok($to->getToken());


var_dump(GoogleCustomSearchEngine::parseJson($to->get()));
