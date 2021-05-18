# [bitrixoa] Bitrix OpenApi
Пакет для генерации [Swagger UI](https://swagger.io/tools/swagger-ui/) на основе аннотаций при работе с [контроллерами](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=43&LESSON_ID=6436&LESSON_PATH=3913.3516.5062.3750.6436) и роутером Bitrix.

## Установка
```angular2html
composer install webpractik/bitrixoa
```

## Генерация
```./vendor/bin/bitrixoa```

### Параметры
1. `--bitrix-generate` параметр указывает, что openapi необходимо смотреть в директорию local/modules
2. `--index-mode` создаст сгенерированный /api-doc/index.php с разметкой swaggerui физически.

## Режимы работы
### A. Через нативный bitrix router (v20+)

Если Ваш роутер не настроен, то прочтите [Настройка роутера Bitrix](docs/bxrouter.md):
1. Добавьте в роутер
```php
use Bitrix\Main\Routing\RoutingConfigurator;

return function (RoutingConfigurator $configurator) {
        $configurator->get('api-doc', [\BitrixOA\BitrixUiController::class, 'apidocAction']);
};
```
2. В таком случае документация откроется по адресу `/api-doc`

### B. Через Bitrix Controller без роутера
1. Создайте в своем модуле файл `.settings.php`
2. Задайте корректный namespace и конфигурации для своего модуля
3. Скопируйте содержимое класса BitrixUiNativeController из этого пакета к себе в модуль, в свой класс-контроллер
4. Обращайтесь по адресу `<адрес сайта>/bitrix/services/main/ajax.php?action=<ваши настройки>` 

### С. Статический UI
Запустить генерацию с флагом `--index-mode` создаст сгенерированный `/api-doc/index.php` с разметкой swaggerui физически.

## Roadmap
- [ ] Сделать генерацию путей на основе анализа роутера
- [ ] Покрыть тестами
