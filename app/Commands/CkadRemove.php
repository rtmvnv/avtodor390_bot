<?php

namespace Rtmvnv\AutodorBot\Commands;

use Rtmvnv\AutodorBot\Helpers;

class CkadRemove extends Command
{
    public function view()
    {
        $text = 'Выберите автомобиль для удаления:' . PHP_EOL;

        $keyboard = [];

        $keyboard[] = [
            $this->addInlineButton(
                'CkadRemove2',
                ['vehicle' => 'А123ВС123']
            )
        ];

        $keyboard[] = [
            $this->addInlineButton(
                'CkadRemove2',
                ['vehicle' => 'B234CH234']
            )
        ];

        $this->sendInlineMessage($text, $keyboard);
    }
}
