<?php

namespace components;

use \models\User;

/**
* Request component for handling requests
* @property string $requestUri
* @property string $requeryMethod
* @property string $contentType
* @property string $requestBody
* @property [] $headers
* @property [] $allowedContentType
**/
class Request {

    private $allowedContentType = ['application/json'];
    private $requestUri;
    private $requeryMethod;
    private $contentType;
    private $requestBody;
    private $headers;


    public function __construct() {
        if (in_array(trim($_SERVER['CONTENT_TYPE']), $this->allowedContentType)) {
            $this->requestUri = $_SERVER['REQUEST_URI'];
            $this->requestMethod = $_SERVER['REQUEST_METHOD'];
            $this->contentType = $_SERVER['CONTENT_TYPE'];

            $this->requestBody = file_get_contents('php://input');

            $this->headers = getallheaders();
        }
    }


    /**
     * Returns request body
     * @return []
    */
    public function getBody() {
        return $this->requestBody;
    }


    /**
     * Returns authorization from header
     * @return string|null
    */
    public function getAuthorization() {
        return $this->headers['authorization'] ?? null;
    }


    /**
     * Returns request method
     * @return string|null
    */
    public function getRequestMethod() {
        return $this->requestMethod ?? null;
    }


    /**
     * Returns requst URI
     * @return string|null
    */
    public function getRequestUri() {
        return $this->requestUri ?? null;
    }


    /**
     * Checks if request is valid (user exists)
     * @return string|null
    */
    public function isValid() {
        $userModel = new User();

        $user = $userModel->findUser($this->getAuthorization());

        return !empty($user->id);
    }
}
