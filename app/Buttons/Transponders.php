<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Commands\Transponders as TranspondersCommand;

class Transponders extends Button
{
    public function caption()
    {
        return 'Транспондеры';
    }

    public function callbackData()
    {
        return 'transponders';
    }

    public function handle()
    {
        (new TranspondersCommand($this->chat, $this->context))->view();
    }
}
