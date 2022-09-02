<?php

namespace Rtmvnv\AutodorBot\Commands;

use Rtmvnv\AutodorBot\Helpers;

class CardSelect extends Command
{
    public function view()
    {
        $text = 'Выберите карту для оплаты:' . PHP_EOL;

        $keyboard = [];

        $card = [
            'alias' => '5457 **** **** 0019',
            'link_id' => '38581e49-0019',
        ];
        $keyboard[] = [
            $this->addInlineButton(
                'CardPay',
                Helpers::object_merge($this->context, ['card' => $card])
            )
        ];

        $card = [
            'alias' => '1234 **** **** 5678',
            'link_id' => '38581e49-5678',
        ];
        $keyboard[] = [
            $this->addInlineButton(
                'CardPay',
                Helpers::object_merge($this->context, ['card' => $card])
            )
        ];

        $keyboard[] = [
            $this->addInlineButton(
                'CardAdd',
                $this->context
            )
        ];

        $keyboard[] = [
            $this->addInlineButton(
                'CardRemove',
                $this->context
            )
        ];

        $this->sendInlineMessage($text, $keyboard);
    }
}
