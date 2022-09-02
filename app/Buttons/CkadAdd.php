<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Commands\CkadAddCountry;

class CkadAdd extends Button
{
    public function caption()
    {
        return "\u{2795} Добавить автомобиль";
    }

    public function callbackData()
    {
        return 'ckad_add';
    }

    public function handle()
    {
        (new CkadAddCountry($this->chat, null))->view();
    }
}
