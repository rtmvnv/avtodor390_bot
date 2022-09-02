<?php

namespace Rtmvnv\AutodorBot\Commands;

class Feedback extends Command
{
    public function view($error = null)
    {
        $text = '<b>Запрос на обратную связь принят, Вам скоро перезвонят...</b>';
        $keyboard = [[$this->addInlineButton('Start', null)]];
        $this->sendInlineMessage($text, $keyboard);
    }
}
