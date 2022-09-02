<?php

namespace Rtmvnv\AutodorBot\Commands;

use Rtmvnv\AutodorBot\Config;
use Rtmvnv\AutodorBot\Request;

class Start extends Command
{
    public function view()
    {
        $this->chat->unsetAllCallbacks();

        // Set "MyCommands" from config
        $myCommandsConfig = Config::getMyCommands();
        $myCommands = [];
        foreach ($myCommandsConfig as $key => $value) {
            $myCommands[] = [
                'command' => $key,
                'description' => $value->description,
            ];
            $this->chat->addGlobalCommand($key, $value->class, $value->context);
        }
        Request::setMyCommands($myCommands);

        $text = '<b>Автодор</b>' . PHP_EOL;
        $text .= '<i>Тестовый макет. Функциональность ограничена. Реальной обработки данных, списаний и зачислений не происходит.</i>' . PHP_EOL;

        // Show transponder 1 balance
        $account = 983247;
        $balance = 420;
        $text .= "Баланс транспондера {$account}: {$balance} руб." . PHP_EOL;

        // Show transponder 2 balance
        $account = 648304;
        $balance = 328;
        $text .= "Баланс транспондера {$account}: {$balance} руб." . PHP_EOL;

        // Show Ckad debt
        $text .= 'Задолженность по ЦКАД: <b>347 руб.</b>' . PHP_EOL;

        $keyboard = [
            [$this->addInlineButton('Transponders', null)],
            [$this->addInlineButton('Ckad', null)],
            [
                $this->addInlineButton('Feedback', null),
                $this->addInlineButton('Help', null),
            ],
            [$this->addInlineButton('Emergency', null),],
        ];
        
        $this->sendInlineMessage($text, $keyboard);
    }

    public function handle($request)
    {
        $this->view();
    }
}
