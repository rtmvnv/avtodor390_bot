<?php

namespace Rtmvnv\AutodorBot\Commands;

use Rtmvnv\AutodorBot\Commands\CkadConfirm;

class CkadAddConfirm extends Command
{
    public function view()
    {
        $text = 'Гос. номер автомобиля указан верно?' . PHP_EOL;
        $text .= "<b>{$this->context->plate}{$this->context->country}</b>";

        $keyboard = [
            [$this->addInlineButton('CkadAddYes', $this->context)],
            [$this->addInlineButton('CkadAddNo', $this->context)],
        ];

        $this->sendInlineMessage($text, $keyboard);
    }
}
