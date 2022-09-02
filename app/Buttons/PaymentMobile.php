<?php

namespace Rtmvnv\AutodorBot\Buttons;

use Rtmvnv\AutodorBot\Commands\Notice;

class PaymentMobile extends Button
{
    public function caption()
    {
        return "\u{1F4F1} Счет мобильного телефона";
    }

    public function callbackData()
    {
        switch ($this->context->purpose) {
            case 'transponder':
                return 'payment_mobile_transponder_' . $this->context->account;
                break;

            case 'ckad':
                return 'payment_mobile_ckad_' . $this->context->vehicle;
                break;

            default:
                throw new Exception("Unknown purpose: '{$this->context->purpose}'", 43407887);
                break;
        }
    }

    public function handle()
    {
        $this->unsetCallback();

        (new Notice($this->chat, [
            'notice' => 'Запрос зарегистрирован, подтвердите оплату в SMS',
            'class' => 'Start'
        ]))->view();
    }
}
