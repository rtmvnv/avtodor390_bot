<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Commands\Notice;

class CardPay extends Button
{
    public function caption()
    {
        return $this->context->card->alias;
    }

    public function callbackData()
    {
        return 'card_pay';
    }

    public function handle()
    {
        $this->unsetCallback();

        (new Notice($this->chat, [
            'notice' => 'Заявка на платеж зарегистрирована',
            'class' => 'Start'
        ]))->view();
    }
}
