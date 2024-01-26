# Модуль расчета стоимости доставки
### Установка composer:
```sh
composer install
composer dump-autoload
```
### Генерация автозагрузчика:
```sh
composer dump-autoload
```
### Настройка калькулятора
#### Вариант добавления и удаления сервиса
```php
    $calculator = new CalculatorDelivery();
    $defaultDelivery = new DefaultDeliveryService();
    $calculator->addDeliveryService($defaultDelivery);
    $calculator->removeDeliveryService($defaultDelivery);
```
#### Вариант добавления нескольких сервисов
```php
    $fastDelivery = new FastDeliveryService();
    $slowDelivery = new SlowDeliveryService();
    $calculator = new CalculatorDelivery([$fastDelivery, $slowDelivery]);
```
### Получение результата
#### Пример запроса
```php
    $shipping = new Shipping('адрес отправителя', 'адрес получателя', 5.0);
```
#### Варианты расчёта по одному сервису
```php
    $result = $calculator->calculateForDeliveryService($request, $fastDelivery);
```
#### Результат
```php
    Array
    (
        [FastDeliveryService] => Array
            (
                [price] => 4100
                [date] => 2024-02-03
                [error] =>
            )
    )
```
#### Варианты расчёта по всем сервисам
```php
    $result = $calculator->calculateForAllDeliveryServices($request);
```
#### Результат
```php
    Array
    (
        [FastDeliveryService] => Array
            (
                [price] => 0
                [date] => 2024-01-27
                [error] => Не удалось найти перевозчика
            )
        [SlowDeliveryService] => Array
            (
                [price] => 2355
                [date] => 2022-06-11
                [error] =>
            )
    )
```