<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Commands\TransponderRemove as TransponderRemoveCommand;

class TransponderRemove extends Button
{
    public function caption()
    {
        return "\u{2796} Удалить транспондер";
    }

    public function callbackData()
    {
        return 'transponder_remove';
    }

    public function handle()
    {
        (new TransponderRemoveCommand($this->chat, $this->context))->view();
    }
}
