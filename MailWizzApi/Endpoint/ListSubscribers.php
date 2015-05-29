<?php
/**
 * This file contains the lists subscribers endpoint for MailWizzApi PHP-SDK.
 * 
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @link http://www.mailwizz.com/
 * @copyright 2013-2015 http://www.mailwizz.com/
 */
 
 
/**
 * MailWizzApi_Endpoint_ListSubscribers handles all the API calls for lists subscribers.
 * 
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @package MailWizzApi
 * @subpackage Endpoint
 * @since 1.0
 */
class MailWizzApi_Endpoint_ListSubscribers extends MailWizzApi_Base
{
    /**
     * Get subscribers from a certain mail list
     * 
     * Note, the results returned by this endpoint can be cached.
     * 
     * @param string $listUid
     * @param integer $page
     * @param integer $perPage
     * @param array $fields 
     * @return MailWizzApi_Http_Response
     */
    public function getSubscribers($listUid, $page = 1, $perPage = 10)
    {
        $client = new MailWizzApi_Http_Client(array(
            'method'        => MailWizzApi_Http_Client::METHOD_GET,
            'url'           => $this->config->getApiUrl(sprintf('lists/%s/subscribers', $listUid)),
            'paramsGet'     => array(
                'page'      => (int)$page, 
                'per_page'  => (int)$perPage,
            ),
            'enableCache'   => true,
        ));
        
        return $response = $client->request();
    }
    
    /**
     * Get one subscriber from a certain mail list
     * 
     * Note, the results returned by this endpoint can be cached.
     * 
     * @param string $listUid
     * @param string $subscriberUid
     * @return MailWizzApi_Http_Response
     */
    public function getSubscriber($listUid, $subscriberUid)
    {
        $client = new MailWizzApi_Http_Client(array(
            'method'        => MailWizzApi_Http_Client::METHOD_GET,
            'url'           => $this->config->getApiUrl(sprintf('lists/%s/subscribers/%s', (string)$listUid, (string)$subscriberUid)),
            'paramsGet'     => array(),
            'enableCache'   => true,
        ));
        
        return $response = $client->request();
    }
    
    /**
     * Create a new subscriber in the given list
     * 
     * @param string $listUid
     * @param array $data
     * @return MailWizzApi_Http_Response
     */
    public function create($listUid, array $data)
    {
        $client = new MailWizzApi_Http_Client(array(
            'method'        => MailWizzApi_Http_Client::METHOD_POST,
            'url'           => $this->config->getApiUrl(sprintf('lists/%s/subscribers', (string)$listUid)),
            'paramsPost'    => $data,
        ));
        
        return $response = $client->request();
    }
    
    /**
     * Update existing subscriber in given list
     * 
     * @param string $listUid
     * @param string $subscriberUid
     * @param array $data
     * @return MailWizzApi_Http_Response
     */
    public function update($listUid, $subscriberUid, array $data)
    {
        $client = new MailWizzApi_Http_Client(array(
            'method'        => MailWizzApi_Http_Client::METHOD_PUT,
            'url'           => $this->config->getApiUrl(sprintf('lists/%s/subscribers/%s', (string)$listUid, (string)$subscriberUid)),
            'paramsPut'     => $data,
        ));
        
        return $response = $client->request();
    }
    
    /**
     * Unsubscribe existing subscriber from given list
     * 
     * @param string $listUid
     * @param string $subscriberUid
     * @return MailWizzApi_Http_Response
     */
    public function unsubscribe($listUid, $subscriberUid)
    {
        $client = new MailWizzApi_Http_Client(array(
            'method'        => MailWizzApi_Http_Client::METHOD_PUT,
            'url'           => $this->config->getApiUrl(sprintf('lists/%s/subscribers/%s/unsubscribe', (string)$listUid, (string)$subscriberUid)),
            'paramsPut'     => array(),
        ));
        
        return $response = $client->request();
    }
    
    /**
     * Unsubscribe existing subscriber by email address
     * 
     * @param string $listUid
     * @param string emailAddress
     * @return MailWizzApi_Http_Response
     */
    public function unsubscribeByEmail($listUid, $emailAddress)
    {
        $response = $this->emailSearch($listUid, $emailAddress);
        
        // the request failed.
        if ($response->isCurlError) {
            return $response;
        }
        
        $bodyData = $response->body->itemAt('data');
        
        // subscriber not found.
        if ($response->isError && $response->httpCode == 404) {
            return $response;
        }

        if (empty($bodyData['subscriber_uid'])) {
            return $response;
        }
        
        return $this->unsubscribe($listUid, $bodyData['subscriber_uid']);
    }
    
    /**
     * Delete existing subscriber in given list
     * 
     * @param string $listUid
     * @param string $subscriberUid
     * @return MailWizzApi_Http_Response
     */
    public function delete($listUid, $subscriberUid)
    {
        $client = new MailWizzApi_Http_Client(array(
            'method'        => MailWizzApi_Http_Client::METHOD_DELETE,
            'url'           => $this->config->getApiUrl(sprintf('lists/%s/subscribers/%s', (string)$listUid, (string)$subscriberUid)),
            'paramsDelete'  => array(),
        ));
        
        return $response = $client->request();
    }
    
    /**
     * Delete existing subscriber by email address
     * 
     * @param string $listUid
     * @param string emailAddress
     * @return MailWizzApi_Http_Response
     */
    public function deleteByEmail($listUid, $emailAddress)
    {
        $response = $this->emailSearch($listUid, $emailAddress);
        $bodyData = $response->body->itemAt('data');
        
        if ($response->isError || empty($bodyData['subscriber_uid'])) {
            return $response;
        }

        return $this->delete($listUid, $bodyData['subscriber_uid']);
    }
    
    /**
     * Search in a list gor given subscriber by email address
     * 
     * @param string $listUid
     * @param string $emailAddress
     * @return MailWizzApi_Http_Response
     */
    public function emailSearch($listUid, $emailAddress)
    {
        $client = new MailWizzApi_Http_Client(array(
            'method'        => MailWizzApi_Http_Client::METHOD_GET,
            'url'           => $this->config->getApiUrl(sprintf('lists/%s/subscribers/search-by-email', (string)$listUid)),
            'paramsGet'     => array('EMAIL' => (string)$emailAddress),
        ));
        
        return $response = $client->request();
    }
    
    /**
     * Create or update a subscriber in given list
     * 
     * @param string $listUid
     * @param array $data
     * @return MailWizzApi_Http_Response
     */
    public function createUpdate($listUid, $data)
    {
        $emailAddress    = !empty($data['EMAIL']) ? $data['EMAIL'] : null;
        $response        = $this->emailSearch($listUid, $emailAddress);
        
        // the request failed.
        if ($response->isCurlError) {
            return $response;
        }
        
        $bodyData = $response->body->itemAt('data');
        
        // subscriber not found.
        if ($response->isError && $response->httpCode == 404) {
            return $this->create($listUid, $data);
        }

        if (empty($bodyData['subscriber_uid'])) {
            return $response;
        }
        
        return $this->update($listUid, $bodyData['subscriber_uid'], $data);
    }
}