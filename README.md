# bitrixoa
Пакет для генерации аннотаций и отрисовки SwUi, при работе с контроллерами Bitrix.
Поставляется сразу с написанным контроллером.

## Установка
```angular2html
composer install webpractik/bitrixoa
```

## Команды для работы

```./vendor/bin/bitrixoa```

### Опции
1. ``` --bitrix-generate```
 Опция указывает, что openapi необходимо смотреть в директорию local/modules
2. ```--index-mode``` Создаст сгенерированный index.php с разметкой swaggerui по адресу api-doc физически, в корне сайта.




## Работа с роутером битрикс

### В режиме работы с роутером 
Если Ваш роутер не настроен, то прочтите [Настройка роутера Bitrix](.docs/bxrouter.md):
1. У себя в модуле создайте файл routes.php с содержимым 
```angular2html
use Bitrix\Main\Routing\RoutingConfigurator;

return function (RoutingConfigurator $configurator) {
    $configurator->prefix('swagger')->group(function (RoutingConfigurator $configurator) {
        $configurator->get('apidoc', [\BitrixOA\BitrixUiController::class, 'apidocAction']);
    });
};
```
2. В таком случае документация откроется по адресу /swagger/apidoc

### В режиме работы с нативными контроллерами Bitrix без роутера
1. Создайте в своем модуле файл .settings.php
2. Задайте корректный namespace и конфигурации для своего модуля
3. Скопируйте содержимое класса BitrixUiNativeContoller из этого пакета к себе в модуль, в свой класс-контроллер
4. Обращайтесь по адресу ```<адрес сайта>/bitrix/services/main/ajax.php?action=<ваши настройки>``` 


