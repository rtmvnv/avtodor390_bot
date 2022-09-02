<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Commands\Notice;

class CardRemove2 extends Button
{
    public function caption()
    {
        return $this->context->card->alias;
    }

    public function callbackData()
    {
        return 'card_remove2';
    }

    public function handle()
    {
        $this->unsetCallback();

        (new Notice($this->chat, [
            'notice' => 'Карта успешно удалена.',
            'class' => 'PaymentMethod',
            'saved_context' => $this->context,
        ]))->view();
    }
}
