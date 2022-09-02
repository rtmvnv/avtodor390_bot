<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Commands\TransponderAdd as TransponderAddCommand;

class TransponderAdd extends Button
{
    public function caption()
    {
        return "\u{2795} Добавить транспондер";
    }

    public function callbackData()
    {
        return 'transponder_add';
    }

    public function handle()
    {
        (new TransponderAddCommand($this->chat, null))->view();
    }
}
