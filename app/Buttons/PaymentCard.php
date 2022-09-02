<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Commands\CardSelect;

class PaymentCard extends Button
{
    public function caption()
    {
        return "\u{1F4B3} Банковская карта";
    }

    public function callbackData()
    {
        switch ($this->context->purpose) {
            case 'transponder':
                return 'payment_card_transponder_' . $this->context->account;
                break;

            case 'ckad':
                return 'payment_card_ckad_' . $this->context->vehicle;
                break;
            
            default:
                throw new Exception("Unknown purpose: '{$this->context->purpose}'", 97079661);
                break;
        }
    }

    public function handle()
    {
        $this->unsetCallback();

        (new CardSelect($this->chat, $this->context))->view();
    }
}
