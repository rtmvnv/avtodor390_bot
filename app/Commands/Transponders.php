<?php

namespace Rtmvnv\AutodorBot\Commands;

class Transponders extends Command
{
    public function view()
    {
        $text = 'Баланс транспондера 983247: 420 руб.' . PHP_EOL;
        $text .= 'Баланс транспондера 648304: 328 руб.' . PHP_EOL;
        $text .= PHP_EOL;
        $text .= 'Выберите действие:' . PHP_EOL;

        $keyboard = [
            [$this->addInlineButton('TransponderSum', ['account' => 983247])],
            [$this->addInlineButton('TransponderSum', ['account' => 648304])],
            [$this->addInlineButton('TransponderAdd', null)],
            [$this->addInlineButton('TransponderRemove', null)],
        ];
        $this->sendInlineMessage($text, $keyboard);
    }
}
