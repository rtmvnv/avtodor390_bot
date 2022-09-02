<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Commands\CkadRemove as CkadRemoveCommand;

class CkadRemove extends Button
{
    public function caption()
    {
        return "\u{2796} Удалить автомобиль";
    }

    public function callbackData()
    {
        return 'ckad_remove';
    }

    public function handle()
    {
        (new CkadRemoveCommand($this->chat, null))->view();
    }
}
