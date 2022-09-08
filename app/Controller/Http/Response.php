<?php

namespace App\Controller\Http;

class Response
{
    private $statusCode = 200;
    private $headers = [];
    private $contentType = 'text/html';
    private $content;

    public function __construct($statusCode, $content, $contentType = 'text/html')
    {
        $this->statusCode = $statusCode;
        $this->content = $content;
        $this->addHeader('Content-Type', $contentType);
    }

    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
    }

    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    public function sendResponse()
    {
        switch ($this->contentType) {
            case 'text/html':
                echo $this->content;
                break;
                // case 'application/json':
                //     $this->sendJsonResponse();
                //     break;
                // default:
                //     $this->sendHtmlResponse();
                //     break;
        }
    }
}
