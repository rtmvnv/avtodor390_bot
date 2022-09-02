<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Commands\Ckad as CkadCommand;

class Ckad extends Button
{
    public function caption()
    {
        return 'ЦКАД';
    }

    public function callbackData()
    {
        return 'ckad';
    }

    public function handle()
    { 
        (new CkadCommand($this->chat, $this->context))->view();
    }
}
