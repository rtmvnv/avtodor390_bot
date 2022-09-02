<?php

namespace Rtmvnv\AutodorBot\Commands;

class Emergency extends Command
{
    public function view($error = null)
    {
        $text = '<b>Ваш вызов принят, Вам скоро перезвонят...</b>';
        $keyboard = [[$this->addInlineButton('Start', null)]];
        $this->sendInlineMessage($text, $keyboard);
    }
}
