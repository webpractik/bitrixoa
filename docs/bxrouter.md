# Инструкция по настройке роутера Bitrix

1. Внутри файла /bitrix/.settings.php добавьте секцию 
```php
  'routing' =>
  array (
    'value' =>
      array (
        'config' =>
        array (
          'custom_routes.php'
        ),
      ),
    'readonly' => true,
  ),
```
2. Внутри папки bitrix/routes добавьте файл custom_routes.php с содержимым:
```php
<?php

use Bitrix\Main\Routing\RoutingConfigurator;

if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/local/routes/custom_routes.php')) {
    $customRoutesClosure = include $_SERVER['DOCUMENT_ROOT'] . '/local/routes/custom_routes.php';
    
    if ($customRoutesClosure instanceof Closure) {
        return $customRoutesClosure;
    }
}

return function (RoutingConfigurator $routingConfigurator) {
    //
};
```
3. Внутри папки local/routes создайте файл custom_routes.php с содержимым:
```php
<?php

use Bitrix\Main\ModuleManager;
use Bitrix\Main\Routing\RoutingConfigurator;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

/**
 * Получение машрутов установленных в local модулей
 *
 * Сделанно анонимной функцией, чтобы все переменные
 * имели локальный пространство имен
 *
 * Поскольку переменные с этими иминами используется ранее в ядре
 *
 * @return array
 */
$getRoutePaths = static function (): array {
    foreach (ModuleManager::getInstalledModules() as $module) {
        $route = $_SERVER['DOCUMENT_ROOT'] . '/local/modules/' . $module['ID'] . '/routes.php';
        if (file_exists($route)) {
            $routes[] = $route;
        }
    }
    return $routes ?? [];
};

return function (RoutingConfigurator $routingConfigurator) use ($getRoutePaths) {
    foreach ($getRoutePaths() as $route) {
        $callback = include $route;
        if ($callback instanceof Closure) {
            $callback($routingConfigurator);
        }
    }
};

```

4. Теперь в каждом модуле вы можете создавать файл routes.php, где регистрировать свои маршруты.

