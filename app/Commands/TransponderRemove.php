<?php

namespace Rtmvnv\AutodorBot\Commands;

class TransponderRemove extends Command
{
    public function view()
    {
        $text = 'Удаление транспондера' . PHP_EOL;
        $text = PHP_EOL;
        $text = 'Выберите действие:' . PHP_EOL;

        $keyboard = [
            [$this->addInlineButton('TransponderRemove2', ['account' => 983247])],
            [$this->addInlineButton('TransponderRemove2', ['account' => 648304])],
        ];
        $this->sendInlineMessage($text, $keyboard);
    }
}
