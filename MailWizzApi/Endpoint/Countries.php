<?php
/**
 * This file contains the countries endpoint for MailWizzApi PHP-SDK.
 * 
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @link http://www.mailwizz.com/
 * @copyright 2013-2015 http://www.mailwizz.com/
 */
 
 
/**
 * MailWizzApi_Endpoint_Countries handles all the API calls for handling the countries and their zones.
 * 
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @package MailWizzApi
 * @subpackage Endpoint
 * @since 1.0
 */
class MailWizzApi_Endpoint_Countries extends MailWizzApi_Base
{
    /**
     * Get all available countries
     * 
     * Note, the results returned by this endpoint can be cached.
     * 
     * @param integer $page
     * @param integer $perPage
     * @return MailWizzApi_Http_Response
     */
    public function getCountries($page = 1, $perPage = 10)
    {
        $client = new MailWizzApi_Http_Client(array(
            'method'        => MailWizzApi_Http_Client::METHOD_GET,
            'url'           => $this->config->getApiUrl('countries'),
            'paramsGet'     => array(
                'page'      => (int)$page, 
                'per_page'  => (int)$perPage
            ),
            'enableCache'   => true,
        ));
        
        return $response = $client->request();
    }
    
    /**
     * Get all available country zones
     * 
     * Note, the results returned by this endpoint can be cached.
     * 
     * @param integer $countryId
     * @param integer $page
     * @param integer $perPage
     * @return MailWizzApi_Http_Response
     */
    public function getZones($countryId, $page = 1, $perPage = 10)
    {
        $client = new MailWizzApi_Http_Client(array(
            'method'        => MailWizzApi_Http_Client::METHOD_GET,
            'url'           => $this->config->getApiUrl(sprintf('countries/%d/zones', $countryId)),
            'paramsGet'     => array(
                'page'      => (int)$page, 
                'per_page'  => (int)$perPage
            ),
            'enableCache'   => true,
        ));
        
        return $response = $client->request();
    }
}