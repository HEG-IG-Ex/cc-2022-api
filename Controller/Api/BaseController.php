<?php

class BaseController
{
    public function __call($name, $arguments)
    {
        $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
    }

    protected function getUriSegments()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode( '/', $uri );
        return $uri;
    }

    protected function getQueryStringParams()
    {
        return parse_str($_SERVER['QUERY_STRING'], $query);
    }

    protected function sendOutput($data, $httpHeaders=array())
    {
        header_remove('Set-Cookie');
        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }
        echo $data;
        exit;
    }
    
    protected function authenticate()
    {
        // Logic for authentication
    }

    protected function setHeaders($headers)
    {
        header_remove('Set-Cookie');
        foreach ($headers as $name => $value) {
            header("$name: $value");
        }
    }
    
   public function handleRequest()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->handleGetRequest();
                break;
            case 'POST':
                $this->handlePostRequest();
                break;
            case 'PATCH':
                $this->handlePatchRequest();
            case 'PUT':
                $this->handlePutRequest();
                break;
            case 'DELETE':
                $this->handleDeleteRequest();
                break;
            default:
                http_response_code(405);
                exit();
        }
    }
    
    protected function handleGetRequest()
    {
        http_response_code(405);
        exit();
    }

    protected function handlePostRequest()
    {
        http_response_code(405);
        exit();
    }

    
    protected function handlePatchRequest()
    {
        http_response_code(405);
        exit();
    }

    protected function handlePutRequest()
    {
        http_response_code(405);
        exit();
    }

    protected function handleDeleteRequest()
    {
        http_response_code(405);
        exit();
    }

}
?>