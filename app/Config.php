<?php

namespace Rtmvnv\AutodorBot;

class Config
{
    public static function getMyCommands()
    {
        $config = json_decode(@file_get_contents(getcwd() . DIRECTORY_SEPARATOR . 'config.json'));
        return $config->my_commands;
    }
}
