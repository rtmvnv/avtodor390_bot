<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$bot = new Rtmvnv\AutodorBot\Bot;
$bot->runOnce();
