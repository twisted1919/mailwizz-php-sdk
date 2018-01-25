<?php
/**
 * This file contains the campaigns endpoint for MailWizzApi PHP-SDK.
 * 
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @link http://www.mailwizz.com/
 * @copyright 2013-2017 http://www.mailwizz.com/
 */
 
 
/**
 * MailWizzApi_Endpoint_CampaignsTracking handles all the API calls for campaigns.
 * 
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @package MailWizzApi
 * @subpackage Endpoint
 * @since 1.0
 */
class MailWizzApi_Endpoint_CampaignsTracking extends MailWizzApi_Base
{
    /**
     * Track campaign url click for certain subscriber 
     *
     * @param string $campaignUid
     * @param string $subscriberUid
     * @param string $hash
     * @return MailWizzApi_Http_Response
     */
    public function trackUrl($campaignUid, $subscriberUid, $hash)
    {
        $client = new MailWizzApi_Http_Client(array(
            'method'    => MailWizzApi_Http_Client::METHOD_GET,
            'url'       => $this->config->getApiUrl(sprintf('campaigns/%s/track-url/%s/%s', (string)$campaignUid, (string)$subscriberUid, (string)$hash)),
            'paramsGet' => array(),
        ));
        
        return $response = $client->request();
    }

    /**
     * Track campaign open for certain subscriber
     *
     * @param string $campaignUid
     * @param string $subscriberUid
     * @return MailWizzApi_Http_Response
     */
    public function trackOpening($campaignUid, $subscriberUid)
    {
        $client = new MailWizzApi_Http_Client(array(
            'method'    => MailWizzApi_Http_Client::METHOD_GET,
            'url'       => $this->config->getApiUrl(sprintf('campaigns/%s/track-opening/%s', (string)$campaignUid, (string)$subscriberUid)),
            'paramsGet' => array(),
        ));

        return $response = $client->request();
    }

    /**
     * Track campaign unsubscribe for certain subscriber
     *
     * @param string $campaignUid
     * @param string $subscriberUid
     * @param array $data
     * @return MailWizzApi_Http_Response
     */
    public function trackUnsubscribe($campaignUid, $subscriberUid, array $data = array())
    {
        $client = new MailWizzApi_Http_Client(array(
            'method'     => MailWizzApi_Http_Client::METHOD_POST,
            'url'        => $this->config->getApiUrl(sprintf('campaigns/%s/track-unsubscribe/%s', (string)$campaignUid, (string)$subscriberUid)),
            'paramsPost' => $data,
        ));

        return $response = $client->request();
    }
}
