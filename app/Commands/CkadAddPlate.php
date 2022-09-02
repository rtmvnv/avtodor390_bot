<?php

namespace Rtmvnv\AutodorBot\Commands;

use Rtmvnv\AutodorBot\Commands\CkadAddConfirm;

class CkadAddPlate extends Command
{
    public function view($error = null)
    {
        if (empty($error)) {
            $text = 'Добавление автомобиля' . PHP_EOL;
        } else {
            $text = $error . PHP_EOL;
        }
        $text .= PHP_EOL;
        $text .= 'Введите гос. номер автомобиля. Пример: "a123bc123"' . PHP_EOL;

        $this->sendCommandMessage($text, null);
    }

    public function handle($request)
    {
        $plate = $this->formatPlate($request, $this->context->country);

        if (empty($plate)) {
            $this->view('Некорректный гос.номер.');
            return;
        }

        $this->context->plate = $plate;
        (new CkadAddConfirm($this->chat, $this->context))->view();
    }

    /**
     * Проверяет правильность формата гос. номера ТС.
     * Для России проверяем номер на соответствие шаблону (Х000ХХ000),
     * если не соответствует выдаем предупреждение, но допускаем использование.
     * Для стран кроме России знак содержать только цифры, латинские буквы
     * и русские буквы А, В, Е, К, М, Н, О, Р, С, Т, X и У.
     * https://ru.wikipedia.org/wiki/%D0%92%D0%B5%D0%BD%D1%81%D0%BA%D0%B0%D1%8F_%D0%BA%D0%BE%D0%BD%D0%B2%D0%B5%D0%BD%D1%86%D0%B8%D1%8F_%D0%BE_%D0%B4%D0%BE%D1%80%D0%BE%D0%B6%D0%BD%D0%BE%D0%BC_%D0%B4%D0%B2%D0%B8%D0%B6%D0%B5%D0%BD%D0%B8%D0%B8
     *
     * @param string $plate   Гос. номер ТС
     * @param string $country Страна регистрации ТС. Пример: "RUS"
     *
     * @return string/false Номер (для России в кириллице) или false
     */
    public function formatPlate($plate, $country)
    {
        // Перевести в верхний регистр, удалить пробелы, удалить RUS
        $plate = mb_strtoupper($plate);
        $plate = str_replace(' ', '', $plate);
        $plate = str_replace('RUS', '', $plate);

        if ($country === 'RUS') {
            if (mb_ereg_match('^\d{3}(CD|D|T)\d{1,3}\d{2,3}$', $plate)) {
                // Дипломатический автомобиль
                // 002 CD 1 78 - глава
                // 002 D 040 78 - дипломат
                // 002 T 003 78 - сотрудник
                return $plate;
            }
            if (mb_ereg_match('^(CD|D|T)\d{3}\d{2}\d{2,3}$', $plate)) {
                // Дипломатический мотоцикл
                // D 876 23 77 - мотоцикл
                return $plate;
            }

            // Разрешены 12 букв кириллицы, имеющие аналоги
            // в латинице — А, В, Е, К, М, Н, О, Р, С, Т, У и Х.
            // Заменить все кириллицей
            $plate = strtr(
                $plate,
                [
                    'A' => 'А',
                    'B' => 'В',
                    'E' => 'Е',
                    'K' => 'К',
                    'M' => 'М',
                    'H' => 'Н',
                    'O' => 'О',
                    'P' => 'Р',
                    'C' => 'С',
                    'T' => 'Т',
                    'X' => 'Х',
                    'Y' => 'У',
                    'R' => 'Р',
                    'S' => 'С',
                    'V' => 'В',
                    'W' => 'В',
                    'U' => 'У',
                    'N' => 'Н'
                ]
            );
        }

        return $plate;
    }
}
