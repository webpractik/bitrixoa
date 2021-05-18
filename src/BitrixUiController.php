<?php
namespace BitrixOA;

use Bitrix\Main\Application;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\ActionFilter\HttpMethod;
use Bitrix\Main\Engine\Controller;
use Bitrix\Main\HttpResponse;
use Bitrix\Main\Request;
use Bitrix\Main\Routing\Route;

class BitrixUiController extends BitrixUiNativeController
{
    protected Route $route;
    
    public function __construct(Request $request = null)
    {
        $this->route = Application::getInstance()->getCurrentRoute();
        parent::__construct($request);
    }
    
    public function getRoute(): Route
    {
        return $this->route;
    }
}
