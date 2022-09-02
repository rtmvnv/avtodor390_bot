<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Commands\CardRemove as CardRemoveCommand;

class CardRemove extends Button
{
    public function caption()
    {
        return 'Удалить карту';
    }

    public function callbackData()
    {
        return 'card_remove';
    }

    public function handle()
    { 
        (new CardRemoveCommand($this->chat, $this->context))->view();
    }
}
