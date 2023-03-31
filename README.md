# Модуль расчета стоимости доставки
### Установка composer:
```sh
composer install
```
### Генерация автозагрузчика:
```sh
composer dump-autoload
```
### Настройка калькулятора
#### Вариант добавления и удаления сервиса
```php
$calculator = new Calculator();

$defaultDelivery = new DefaultDeliveryService();
$calculator->addDeliveryService($defaultDelivery);

$calculator->removeDeliveryService($defaultDelivery);

$calculator->addDeliveryService(new FastDeliveryService(['base_url' => 'https://fast.delivery']));
```
#### Вариант добавления нескольких сервисов
```php
$fastDelivery = new FastDeliveryService(['base_url' => 'https://fast.delivery']);
$slowDelivery = new SlowDeliveryService(['base_url' => 'https://slow.delivery']);
$calculator = new Calculator([$fastDelivery, $slowDelivery]);
```
### Получение результата
#### Пример запроса
```php
$request = new Request('адрес отправителя', 'адрес получателя', 5.0);
```
#### Варианты расчёта

```php
$result = $calculator->calculateForAllDeliveryServices($request);

$result = $calculator->calculateForDeliveryService($request, $fastDelivery);
```
#### Результат
```php
[orders:protected] => Array
    [CostCalculationModule\Infrastructure\Delivery\Service\FastDeliveryService] => 
        CostCalculationModule\Infrastructure\Order\Service\Order Object
        (
            [price:CostCalculationModule\Infrastructure\Order\Service\Order:private] => 850
            [date:CostCalculationModule\Infrastructure\Order\Service\Order:private] => 2023-04-11
            [error:CostCalculationModule\Infrastructure\Order\Service\Order:private] => error
        )
    [CostCalculationModule\Infrastructure\Delivery\Service\SlowDeliveryService] => 
        CostCalculationModule\Infrastructure\Order\Service\Order Object
        (
            [price:CostCalculationModule\Infrastructure\Order\Service\Order:private] => 450
            [date:CostCalculationModule\Infrastructure\Order\Service\Order:private] => 2017-10-20
            [error:CostCalculationModule\Infrastructure\Order\Service\Order:private] => error
        )
    [CostCalculationModule\Infrastructure\Delivery\Service\DefaultDeliveryService] => 
        CostCalculationModule\Infrastructure\Order\Service\Order Object
        (
            [price:CostCalculationModule\Infrastructure\Order\Service\Order:private] => 850
            [date:CostCalculationModule\Infrastructure\Order\Service\Order:private] => 2017-10-20
            [error:CostCalculationModule\Infrastructure\Order\Service\Order:private] => error
        )
```