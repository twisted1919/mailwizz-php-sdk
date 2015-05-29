<?php
/**
 * This file contains the MailWizzApi_Http_Client class used in the MailWizzApi PHP-SDK.
 * 
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @link http://www.mailwizz.com/
 * @copyright 2013-2015 http://www.mailwizz.com/
 */
 
 
/**
 * MailWizzApi_Http_Client is the http client interface used to make the remote requests and receive the responses.
 * 
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @package MailWizzApi
 * @subpackage Http
 * @since 1.0
 */
class MailWizzApi_Http_Client extends MailWizzApi_Base
{
    /**
     * Marker for GET requests.
     */
    const METHOD_GET     = 'GET';
    
    /**
     * Marker for POST requests.
     */
    const METHOD_POST    = 'POST';
    
    /**
     * Marker for PUT requests.
     */
    const METHOD_PUT     = 'PUT';
    
    /**
     * Marker for DELETE requests.
     */
    const METHOD_DELETE = 'DELETE';
    
    /**
     * Marker for the client version.
     */
    const CLIENT_VERSION = '1.0';

    /**
     * @var MailWizzApi_Params the GET params sent in the request.
     */
    public $paramsGet = array();
    
    /**
     * @var MailWizzApi_Params the POST params sent in the request.
     */
    public $paramsPost = array();
    
    /**
     * @var MailWizzApi_Params the PUT params sent in the request.
     */
    public $paramsPut = array();
    
    /**
     * @var MailWizzApi_Params the DELETE params sent in the request.
     */
    public $paramsDelete = array();
    
    /**
     * @var MailWizzApi_Params the headers sent in the request.
     */
    public $headers = array();

    /**
     * @var string the url where the remote calls will be made.
     */
    public $url;

    /**
     * @var int the default timeout for request.
     */
    public $timeout = 30;
    
    /**
     * @var bool whether to sign the request.
     */
    public $signRequest = true;
    
    /**
     * @var bool whether to get the response headers.
     */
    public $getResponseHeaders = false;
    
    /**
     * @var bool whether to cache the request response.
     */
    public $enableCache = false;
    
    /**
     * @var string the method used in the request.
     */
    public $method = self::METHOD_GET;

    /**
     * Constructor.
     * 
     * @param mixed $options
     */
    public function __construct(array $options = array())
    {
        $this->populateFromArray($options);
        
        foreach (array('paramsGet', 'paramsPost', 'paramsPut', 'paramsDelete', 'headers') as $param) {
            if (!($this->$param instanceof MailWizzApi_Params)) {
                $this->$param = new MailWizzApi_Params($this->$param);
            }
        }
    }

    /**
     * Whether the request method is a GET method.
     * 
     * @return bool
     */
    public function getIsGetMethod() 
    {
        return strtoupper($this->method) === self::METHOD_GET;
    }
    
    /**
     * Whether the request method is a POST method.
     * 
     * @return bool
     */
    public function getIsPostMethod() 
    {
        return strtoupper($this->method) === self::METHOD_POST;
    }
    
    /**
     * Whether the request method is a PUT method.
     * 
     * @return bool
     */
    public function getIsPutMethod() 
    {
        return strtoupper($this->method) === self::METHOD_PUT;
    }
    
    /**
     * Whether the request method is a DELETE method.
     * 
     * @return bool
     */
    public function getIsDeleteMethod() 
    {
        return strtoupper($this->method) === self::METHOD_DELETE;
    }
    
    /**
     * Makes the request to the remote host.
     * 
     * @return MailWizzApi_Http_Response
     */
    public function request()
    {
        $request = new MailWizzApi_Http_Request($this);
        return $response = $request->send();
    }
}