<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Commands\Notice;

class CardAdd extends Button
{
    public function caption()
    {
        return 'Добавить карту';
    }

    public function callbackData()
    {
        return 'card_add';
    }

    public function handle()
    {
        (new Notice($this->chat, [
            'notice' => 'Вам отправлено SMS со ссылкой для добавления карты и оплаты.',
            'class' => 'Start'
        ]))->view();
    }
}
