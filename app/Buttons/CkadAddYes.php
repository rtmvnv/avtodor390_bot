<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Commands\Ckad;

class CkadAddYes extends Button
{
    public function caption()
    {
        return 'Верно';
    }

    public function callbackData()
    {
        return 'ckad_add_yes';
    }

    public function handle()
    {
        (new Ckad($this->chat, null))->view();
    }
}
