<?php

namespace Rtmvnv\AutodorBot\Commands;

class Help extends Command
{
    public function view($error = null)
    {
        $text = 'Сервис оплаты услуг <a href="https://avtodor-tr.ru/ru/">Автодор</a>.';
        $keyboard = [[$this->addInlineButton('Start', null)]];
        $this->sendInlineMessage($text, $keyboard);
    }
}
