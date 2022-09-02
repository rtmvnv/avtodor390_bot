<?php

namespace Rtmvnv\AutodorBot\Commands;

class Ckad extends Command
{
    public function view()
    {
        $text = 'Задолженность за проезд по ЦКАД:' . PHP_EOL;
        $text .= 'Автомобиль А123ВС123 - <b>120 руб.</b>' . PHP_EOL;
        $text .= 'Автомобиль В234СН234 - <b>227 руб.</b>' . PHP_EOL;
        $text .= PHP_EOL;
        $text .= 'Выберите действие:' . PHP_EOL;

        $keyboard = [];
        $comission = 2;

        $sum = 120;
        $keyboard[] = [$this->addInlineButton(
            'CkadPay',
            [
                'vehicle' => 'А123ВС123',
                'sum_nett' => $sum,
                'comission' => 2,
                'sum_gross' => $sum * (100 + $comission) / 100,
                'purpose' => 'ckad',
                'comment' => 'Оплата задолженности за проезд по ЦКАД автомобиля А123ВС123.',
            ]
        )];

        $sum = 227;
        $keyboard[] = [$this->addInlineButton(
            'CkadPay',
            [
                'vehicle' => 'В234СН234',
                'sum_nett' => $sum,
                'comission' => 2,
                'sum_gross' => $sum * (100 + $comission) / 100,
                'purpose' => 'ckad',
                'comment' => 'Оплата задолженности за проезд по ЦКАД автомобиля В234СН234.',
            ]
        )];

        $keyboard[] = [$this->addInlineButton('CkadAdd', null)];
        $keyboard[] = [$this->addInlineButton('CkadRemove', null)];

        $this->sendInlineMessage($text, $keyboard);
    }
}
