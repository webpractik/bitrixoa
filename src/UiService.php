<?php
namespace BitrixOA;

use Exception;
use BitrixOA\UiPage;

class UiService
{
    private UiPage $uiPage;
    
    public function __construct($yamlPath)
    {
        $this->uiPage = new UiPage($yamlPath);
    }
    
    /**
     * @throws \Exception
     */
    public function exportWithIndexPage()
    {
        if (!is_dir('local')) {
            throw new Exception('В месте вызова не существует директория local');
        }
        
        try {
            mkdir('api-doc');
            $fp = fopen('api-doc/index.php', 'w');
            fwrite($fp, $this->uiPage->getHtml());
            fclose($fp);
            
        } catch (Exception $exception) {
            echo 'Во время экспорта документации произошла ошибка';
            echo $exception->getMessage();
            echo $exception->getTraceAsString();
        }
    }
    
    public function exportWithBXRouteMode()
    {
    
    }
}
