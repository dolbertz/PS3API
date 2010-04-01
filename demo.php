<?php

require_once 'ps3api.php';

Ps3ApiConfig::$serverUrl = 'myLittleServer.com';
$Ps3Api = Ps3Api::getInstance();

$hero = $Ps3Api->getHero('dirk_olbertz');

$hero->getSidekicks();
$hero->sidekicks[0]->fetch();
$hero->sidekicks[0]->getSidekicks();

$hero->getGames();
$hero->sidekicks[0]->getGames();

print_r($hero);