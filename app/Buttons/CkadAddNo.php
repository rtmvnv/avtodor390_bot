<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Commands\CkadAddCountry;

class CkadAddNo extends Button
{
    public function caption()
    {
        return 'Изменить';
    }

    public function callbackData()
    {
        return 'ckad_add_no';
    }

    public function handle()
    {
        (new CkadAddCountry($this->chat, $this->context))->view();
    }
}
