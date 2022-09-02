<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Commands\Notice;

class TransponderRemove2 extends Button
{
    public function caption()
    {
        return 'Удалить транспондер ' . $this->context->account;
    }

    public function callbackData()
    {
        return 'transponder_remove_' . $this->context->account;
    }

    public function handle()
    {
        $this->unsetCallback();

        (new Notice(
            $this->chat,
            [
                'notice' => 'Транспондер ' . $this->context->account . ' удален',
                'class' => 'Transponders'
            ]
        ))->view();
    }
}
