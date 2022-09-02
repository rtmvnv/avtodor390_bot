# A simple proof of concept prototype of a Telegram bot for Avtodor

https://t.me/avtodor390_bot

## Bot Status Tree
```plantuml
@startuml
'https://plantuml.com/state-diagram
title Avtodor390 Telegram Bot Status Tree

[*] --> Start : /start
Start -right-> Emergency : /emergency
Start -right-> Feedback : /feedback
Start -right-> Help : /help
Start --> Transponders : /transponders
Start --> Ckad : /ckad

Transponders --> TransponderSum: [+]account
Transponders --> TransponderAdd
TransponderAdd --> TransponderAdd2
TransponderAdd2 --> TransponderSum: [+]account
TransponderSum --> PaymentMethod: [+]purpose=transponder\n[+]sum_nett\n[+]sum_gross\n[+]comission\n[+]comment
Transponders --> TransponderRemove
TransponderRemove --> TransponderRemove2
TransponderRemove2 --> Transponders

Ckad ---> PaymentMethod: [+]purpose=ckad\n[+]sum_nett\n[+]sum_gross\n[+]comission\n[+]vehicle\n[+]comment
Ckad -up-> CkadCountry : Добавить автомобиль
CkadCountry --> CkadPlate
CkadPlate --> CkadConfirm
CkadConfirm --> Ckad
Ckad -> CkadRemove
CkadRemove --> CkadRemove2
CkadRemove2 --> Ckad

PaymentMethod --> CardSelect : Карта
PaymentMethod --> PaymentMobile : Счет мобильного телефона

CardSelect --> CardRemove
CardSelect ---> CardAdd
CardSelect ---> CardPay
CardRemove --> CardRemove2
CardRemove2 --> CardSelect

Emergency --> [*]
Feedback --> [*]
Help --> [*]

Start : Меню
    Start :
    Start : - Emergency
    Start : - Feedback
    Start : - Help
    Start : - Transponders
    Start : - Ckad
    note left of Start
    Баланс транспондера 983247: 420 руб.
    Баланс транспондера 648304: 328 руб.
    Задолженность по ЦКАД: 347 руб.

    Выберите действие
    - Вызов аварийного комиссара
    - Обратная связь
    - О сервисе
    - Транспондеры
    - ЦКАД
    end note
Transponders: Транспондеры
    Transponders:
    Transponders: - TransponderSum(983247)
    Transponders: - TransponderSum(648304)
    Transponders: - TransponderAdd
    Transponders: - TransponderRemove
    note left of Transponders
    Выберите действие:
    - Пополнить 983247
    - Пополнить 648304
    - Добавить транспондер
    - Удалить транспондер
    end note
Ckad: ЦКАД
    Ckad:
    Ckad: - CkadPay(А123ВС123)
    Ckad: - CkadPay(В234СН234)
    Ckad: - CkadAdd
    Ckad: - CkadRemove
    note right of Ckad
    Задолженность за проезд по ЦКАД:
    Автомобиль А123ВС123 - 120 руб.
    Автомобиль В234СН234 - 227 руб.

    Выберите действие:
    - Оплатить 120 руб. за А123ВС123
    - Оплатить 227 руб. за В234СН234
    - Добавить автомобиль
    - Удалить автомобиль
    end note
Emergency: Вызов аварийного\nкомиссара
Feedback: Обратная\nсвязь
Help: О сервисе
TransponderSum: Запрос суммы\nпополнения
    note right of TransponderSum
    Пополнение транспондера 983247

    Введите сумму от 100 руб.:
    end note
TransponderAdd: Номер ЛС
    note left of TransponderAdd
    Введите номер
    лицевого счета
    end note
TransponderAdd2: Номер\nтранспондера
    note left of TransponderAdd2
    Введите
    последние 4 цифры
    номера транспондера
    end note
TransponderRemove: Удаление транспондера
    TransponderRemove: 
    TransponderRemove: - TransponderRemove2(983247)
    TransponderRemove: - TransponderRemove2(648304)
    note bottom of TransponderRemove
    Выберите действие

    - Удалить транспондер 983247
    - Удалить транспондер 648304
    end note
TransponderRemove2: Транспондер удален
CkadCountry: Ввод кода страны\nдобавляемого автомобиля
CkadPlate: Ввод госномера\nдобавляемого автомобиля
CkadConfirm: Подтверждение госномера\nдобавляемого автомобиля
CkadRemove: Удаление\nавтомобиля
CkadRemove2: Автомобиль удален
PaymentMethod: Выбор способа оплаты
    note right of PaymentMethod
    Комиссия XX%.
    Сумма к оплате XX руб.

    Выберите способ оплаты:
    - Счет мобильного телефона
    - Банковская карта
    end note
CardSelect: Выбор банковской карты
    CardSelect: - CardPay(5457 **** **** 0019)
    CardSelect: - CardPay(1234 **** **** 5678)
    CardSelect: - CardAdd
    CardSelect: - CardRemove
    note right of CardSelect
    Выберите карту для оплаты:
    - 5457 **** **** 0019
    - 1234 **** **** 5678
    - Добавить карту
    - Удалить карту
    end note
CardRemove: Удаление карты
    note right of CardRemove
    Выберите карту
    для удаления:
    - 5457 **** **** 0019
    - (1234 **** **** 5678
    end note
CardRemove2:
    note bottom of CardRemove2
    Карта успешно удалена.
    end note
CardPay:
    note bottom of CardPay
    Заявка на платеж
    зарегистрирована
    end note
CardAdd:
    note bottom of CardAdd
    Ссылка на 
    добавление карты
    и оплату
    end note
PaymentMobile:
    note bottom of PaymentMobile
    Оплата прошла успешно
    end note

@enduml
```

## Process monitoring
[Supervisor](http://supervisord.org/) is used to keep the script running.

A short instruction from Laravel
https://laravel.com/docs/8.x/queues#supervisor-configuration

Supervisor config file `/etc/supervisord.conf`
 
Process config file is listed below `/etc/supervisord.d/avtodor390_bot.ini`
 
```ini
[program:avtodor390_bot]
command=/home/superuser/projects/avtodor390_bot/run.sh
user=superuser
autostart=true
autorestart=true
stderr_logfile=/tmp/avtodor390_bot.err
stdout_logfile=/tmp/avtodor390_bot.out
numprocs=1
directory=/home/superuser/projects/avtodor390_bot
```

Starting process:
```
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start avtodor390_bot:*
```

## Other Resources
[Emoji Unicode table](https://www.unicode.org/emoji/charts/full-emoji-list.html)
