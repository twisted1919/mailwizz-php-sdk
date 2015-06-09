<?php
/**
 * This file contains the campaigns endpoint for MailWizzApi PHP-SDK.
 * 
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @link http://www.mailwizz.com/
 * @copyright 2013-2015 http://www.mailwizz.com/
 */
 
 
/**
 * MailWizzApi_Endpoint_Campaigns handles all the API calls for campaigns.
 * 
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @package MailWizzApi
 * @subpackage Endpoint
 * @since 1.0
 */
class MailWizzApi_Endpoint_Campaigns extends MailWizzApi_Base
{
    /**
     * Get all the campaigns of the current customer
     * 
     * Note, the results returned by this endpoint can be cached.
     * 
     * @param integer $page
     * @param integer $perPage
     * @return MailWizzApi_Http_Response
     */
    public function getCampaigns($page = 1, $perPage = 10)
    {
        $client = new MailWizzApi_Http_Client(array(
            'method'        => MailWizzApi_Http_Client::METHOD_GET,
            'url'           => $this->config->getApiUrl('campaigns'),
            'paramsGet'     => array(
                'page'      => (int)$page, 
                'per_page'  => (int)$perPage
            ),
            'enableCache'   => true,
        ));
        
        return $response = $client->request();
    }
    
    /**
     * Get one campaign
     * 
     * Note, the results returned by this endpoint can be cached.
     * 
     * @param string $campaignUid
     * @return MailWizzApi_Http_Response
     */
    public function getCampaign($campaignUid)
    {
        $client = new MailWizzApi_Http_Client(array(
            'method'        => MailWizzApi_Http_Client::METHOD_GET,
            'url'           => $this->config->getApiUrl(sprintf('campaigns/%s', (string)$campaignUid)),
            'paramsGet'     => array(),
            'enableCache'   => true,
        ));
        
        return $response = $client->request();
    }
    
    /**
     * Create a new campaign
     * 
     * @param array $data
     * @return MailWizzApi_Http_Response
     */
    public function create(array $data)
    {
        if (isset($data['template']['content'])) {
            $data['template']['content'] = base64_encode($data['template']['content']);
        }
        
        if (isset($data['template']['archive'])) {
            $data['template']['archive'] = base64_encode($data['template']['archive']);
        }
        
        $client = new MailWizzApi_Http_Client(array(
            'method'        => MailWizzApi_Http_Client::METHOD_POST,
            'url'           => $this->config->getApiUrl('campaigns'),
            'paramsPost'    => array(
                'campaign'  => $data
            ),
        ));
        
        return $response = $client->request();
    }
    
    /**
     * Update existing campaign for the customer
     * 
     * @param string $campaignUid
     * @param array $data
     * @return MailWizzApi_Http_Response
     */
    public function update($campaignUid, array $data)
    {
        if (isset($data['template']['content'])) {
            $data['template']['content'] = base64_encode($data['template']['content']);
        }
        
        if (isset($data['template']['archive'])) {
            $data['template']['archive'] = base64_encode($data['template']['archive']);
        }
        
        $client = new MailWizzApi_Http_Client(array(
            'method'        => MailWizzApi_Http_Client::METHOD_PUT,
            'url'           => $this->config->getApiUrl(sprintf('campaigns/%s', $campaignUid)),
            'paramsPut'     => array(
                'campaign'  => $data
            ),
        ));
        
        return $response = $client->request();
    }
    
    /**
     * Copy existing campaign for the customer
     * 
     * @param string $campaignUid
     * @return MailWizzApi_Http_Response
     */
    public function copy($campaignUid)
    {
        $client = new MailWizzApi_Http_Client(array(
            'method'    => MailWizzApi_Http_Client::METHOD_POST,
            'url'       => $this->config->getApiUrl(sprintf('campaigns/%s/copy', $campaignUid)),
        ));
        
        return $response = $client->request();
    }
    
    /**
     * Pause/Unpause existing campaign
     * 
     * @param string $campaignUid
     * @return MailWizzApi_Http_Response
     */
    public function pauseUnpause($campaignUid)
    {
        $client = new MailWizzApi_Http_Client(array(
            'method'    => MailWizzApi_Http_Client::METHOD_PUT,
            'url'       => $this->config->getApiUrl(sprintf('campaigns/%s/pause-unpause', $campaignUid)),
        ));
        
        return $response = $client->request();
    }
    
    /**
     * Mark existing campaign as sent
     * 
     * @param string $campaignUid
     * @return MailWizzApi_Http_Response
     */
    public function markSent($campaignUid)
    {
        $client = new MailWizzApi_Http_Client(array(
            'method'    => MailWizzApi_Http_Client::METHOD_PUT,
            'url'       => $this->config->getApiUrl(sprintf('campaigns/%s/mark-sent', $campaignUid)),
        ));
        
        return $response = $client->request();
    }
    
    /**
     * Delete existing campaign for the customer
     * 
     * @param string $campaignUid
     * @return MailWizzApi_Http_Response
     */
    public function delete($campaignUid)
    {
        $client = new MailWizzApi_Http_Client(array(
            'method'    => MailWizzApi_Http_Client::METHOD_DELETE,
            'url'       => $this->config->getApiUrl(sprintf('campaigns/%s', $campaignUid)),
        ));
        
        return $response = $client->request();
    }
}