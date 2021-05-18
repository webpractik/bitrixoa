<?php
namespace BitrixOA;

use Bitrix\Main\Application;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\ActionFilter\HttpMethod;
use Bitrix\Main\Engine\Controller;
use Bitrix\Main\HttpResponse;
use Bitrix\Main\Request;
use Exception;

class BitrixUiNativeController extends Controller
{
    protected function getDefaultPreFilters(): array
    {
        return [
            new HttpMethod([
                HttpMethod::METHOD_GET,
                HttpMethod::METHOD_POST,
            ]),
            new Csrf(false),
        ];
    }
    
    public function apidocAction()
    {
        if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/local/bitrixoa.yaml')) {
            throw new Exception('Файл с разметкой не существует');
        }
        $swaggerPage = (new UiPage(BitrixOaConfig::YAML_FILE_DEFAULT_PATH))->getHtml();
        
        $response = new HttpResponse();
        $response->setContent($swaggerPage);
        return $response;
    }
}
