<?php
/**
 * This file contains the transactional emails endpoint for MailWizzApi PHP-SDK.
 * 
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @link http://www.mailwizz.com/
 * @copyright 2013-2015 http://www.mailwizz.com/
 */
 
 
/**
 * MailWizzApi_Endpoint_TransactionalEmails handles all the API calls for transactional emails.
 * 
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @package MailWizzApi
 * @subpackage Endpoint
 * @since 1.0
 */
class MailWizzApi_Endpoint_TransactionalEmails extends MailWizzApi_Base
{
    /**
     * Get all transactional emails of the current customer
     * 
     * Note, the results returned by this endpoint can be cached.
     * 
     * @param integer $page
     * @param integer $perPage
     * @return MailWizzApi_Http_Response
     */
    public function getEmails($page = 1, $perPage = 10)
    {
        $client = new MailWizzApi_Http_Client(array(
            'method'        => MailWizzApi_Http_Client::METHOD_GET,
            'url'           => $this->config->getApiUrl('transactional-emails'),
            'paramsGet'     => array(
                'page'      => (int)$page, 
                'per_page'  => (int)$perPage
            ),
            'enableCache'   => true,
        ));
        
        return $response = $client->request();
    }
    
    /**
     * Get one transactional email
     * 
     * Note, the results returned by this endpoint can be cached.
     * 
     * @param string $emailUid
     * @return MailWizzApi_Http_Response
     */
    public function getEmail($emailUid)
    {
        $client = new MailWizzApi_Http_Client(array(
            'method'        => MailWizzApi_Http_Client::METHOD_GET,
            'url'           => $this->config->getApiUrl(sprintf('transactional-emails/%s', (string)$emailUid)),
            'paramsGet'     => array(),
            'enableCache'   => true,
        ));
        
        return $response = $client->request();
    }
    
    /**
     * Create a new transactional email
     * 
     * @param array $data
     * @return MailWizzApi_Http_Response
     */
    public function create(array $data)
    {
        if (!empty($data['body'])) {
            $data['body'] = base64_encode($data['body']);
        }
        
        if (!empty($data['plain_text'])) {
            $data['plain_text'] = base64_encode($data['plain_text']);
        }
        
        $client = new MailWizzApi_Http_Client(array(
            'method'        => MailWizzApi_Http_Client::METHOD_POST,
            'url'           => $this->config->getApiUrl('transactional-emails'),
            'paramsPost'    => array(
                'email'  => $data
            ),
        ));
        
        return $response = $client->request();
    }
    
    /**
     * Delete existing transactional email
     * 
     * @param string $emailUid
     * @return MailWizzApi_Http_Response
     */
    public function delete($emailUid)
    {
        $client = new MailWizzApi_Http_Client(array(
            'method'    => MailWizzApi_Http_Client::METHOD_DELETE,
            'url'       => $this->config->getApiUrl(sprintf('transactional-emails/%s', $emailUid)),
        ));
        
        return $response = $client->request();
    }
}