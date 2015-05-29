<?php
/**
 * This file contains the lists fields endpoint for MailWizzApi PHP-SDK.
 * 
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @link http://www.mailwizz.com/
 * @copyright 2013-2015 http://www.mailwizz.com/
 */
 
 
/**
 * MailWizzApi_Endpoint_ListFields handles all the API calls for handling the list custom fields.
 * 
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @package MailWizzApi
 * @subpackage Endpoint
 * @since 1.0
 */
class MailWizzApi_Endpoint_ListFields extends MailWizzApi_Base
{
    /**
     * Get fields from a certain mail list
     * 
     * Note, the results returned by this endpoint can be cached.
     * 
     * @param string $listUid
     * @return MailWizzApi_Http_Response
     */
    public function getFields($listUid)
    {
        $client = new MailWizzApi_Http_Client(array(
            'method'        => MailWizzApi_Http_Client::METHOD_GET,
            'url'           => $this->config->getApiUrl(sprintf('lists/%s/fields', $listUid)),
            'paramsGet'     => array(),
            'enableCache'   => true,
        ));
        
        return $response = $client->request();
    }
}