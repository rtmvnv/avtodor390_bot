<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Commands\Notice;

class CkadRemove2 extends Button
{
    public function caption()
    {
        return "Удалить {$this->context->vehicle}";
    }

    public function callbackData()
    {
        return 'ckad_remove2';
    }

    public function handle()
    {
        $this->unsetCallback();

        (new Notice(
            $this->chat,
            [
                'notice' => "Автомобиль {$this->context->vehicle} удален.",
                'class' => 'Ckad'
            ]
        ))->view();
    }
}
