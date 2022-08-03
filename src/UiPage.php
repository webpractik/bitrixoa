<?php
namespace BitrixOA;

class UiPage
{
    private string $swaggerUiBlank;
    
    
    public function __construct(string $yamlPath)
    {
        $this->swaggerUiBlank =  '
            <!DOCTYPE html>
            <html lang="en">
              <head>
                <meta charset="UTF-8">
                <title>Swagger UI</title>
                <link rel="stylesheet" type="text/css" href="https://unpkg.com/swagger-ui-dist@4.13.2/swagger-ui.css" >
                <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
                <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
                <style>
                  html
                  {
                    box-sizing: border-box;
                    overflow: -moz-scrollbars-vertical;
                    overflow-y: scroll;
                  }
                  *,
                  *:before,
                  *:after
                  {
                    box-sizing: inherit;
                  }
            
                  body
                  {
                    margin:0;
                    background: #fafafa;
                  }
                </style>
              </head>
            
              <body>
                <div id="swagger-ui"></div>
                <script src="https://unpkg.com/swagger-ui-dist@4.13.2/swagger-ui-standalone-preset.js"></script>
                <script src="https://unpkg.com/swagger-ui-dist@4.13.2/swagger-ui-bundle.js"></script>
                <script>
                window.onload = function() {
                  // Begin Swagger UI call region
                    console.log(window.location.pathname);
                  const ui = SwaggerUIBundle({
                    url: window.location.protocol + "//" + window.location.hostname + "/'.$yamlPath.'",
                    dom_id: "#swagger-ui",
                    deepLinking: true,
                      presets: [
                    SwaggerUIBundle.presets.apis,
                    SwaggerUIStandalonePreset
                ],
                      layout: "StandaloneLayout"
                  })
                // End Swagger UI call region
            window.ui = ui
            }
            </script>
              </body>
            </html>';
    }
    
    public function getHtml()
    {
        return $this->swaggerUiBlank;
    }
}
