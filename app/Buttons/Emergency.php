<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Commands\Emergency as EmergencyCommand;

class Emergency extends Button
{
    public function caption()
    {
        return "Вызов аварийного комиссара";
    }

    public function callbackData()
    {
        return 'emergency';
    }

    public function handle()
    {
        (new EmergencyCommand($this->chat, null))->view();
    }
}
