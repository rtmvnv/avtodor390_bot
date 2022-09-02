<?php

namespace Rtmvnv\AutodorBot\Commands;

use Rtmvnv\AutodorBot\Commands\CkadAddPlate;

class CkadAddCountry extends Command
{
    public function view($error = null)
    {
        if (empty($error)) {
            $text = 'Добавление автомобиля' . PHP_EOL;
        } else {
            $text = $error . PHP_EOL;
        }
        $text .= PHP_EOL;
        $text .= 'Введите код страны регистрации автомобиля. Например "rus"' . PHP_EOL;

        $keyboard = [
            [
                $this->addReplyButton('RUS'),
                $this->addReplyButton('ARM'),
                $this->addReplyButton('AZE'),
                $this->addReplyButton('BLR'),
            ],
            [
                $this->addReplyButton('DEU'),
                $this->addReplyButton('GEO'),
                $this->addReplyButton('KAZ'),
                $this->addReplyButton('KGZ'),
            ],
            [
                $this->addReplyButton('LTU'),
                $this->addReplyButton('LVA'),
                $this->addReplyButton('MDA'),
                $this->addReplyButton('POL'),
            ],
            [
                $this->addReplyButton('ROU'),
                $this->addReplyButton('SRB'),
                $this->addReplyButton('UKR'),
                $this->addReplyButton('UZB'),
            ],
        ];

        $this->sendCommandMessage($text, $keyboard);
    }

    public function handle($request)
    {
        $country = (mb_strtoupper(trim($request)));

        if (strlen($country) != 3) {
            $this->view('Некорректный код страны.');
            return;
        }

        $this->context->country = $request;
        (new CkadAddPlate($this->chat, $this->context))->view();
    }
}
