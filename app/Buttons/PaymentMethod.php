<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Commands\PaymentMethod as PaymentMethodCommand;

class PaymentMethod extends Button
{
    public function caption()
    {
        return 'Способ оплаты';
    }

    public function callbackData()
    {
        switch ($this->context->purpose) {
            case 'transponder':
                return 'payment_method_transponder_' . $this->context->account;
                break;

            case 'ckad':
                return 'payment_method_ckad_' . $this->context->vehicle;
                break;

            default:
                throw new Exception("Unknown purpose: '{$this->context->purpose}'", 19096208);
                break;
        }
    }

    public function handle()
    { 
        (new PaymentMethodCommand($this->chat, $this->context))->view();
    }
}
