<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Commands\Help as HelpCommand;

class Help extends Button
{
    public function caption()
    {
        return "\u{2753} О сервисе";
    }

    public function callbackData()
    {
        return 'help';
    }

    public function handle()
    {
        (new HelpCommand($this->chat, null))->view();
    }
}
