<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Commands\Start as StartCommand;

class Start extends Button
{
    public function caption()
    {
        return 'Главное меню';
    }

    public function callbackData()
    {
        return 'start';
    }

    public function handle()
    {
        $command = new StartCommand($this->chat, $this->context);
        $command->view();
    }
}
