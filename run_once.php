<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(getcwd());
$dotenv->load();

$bot = new Rtmvnv\AutodorBot\Bot;
$bot->runOnce();
