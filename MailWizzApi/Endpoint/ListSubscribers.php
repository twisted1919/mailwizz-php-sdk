<?php
/**
 * This file contains the lists endpoint for MailWizzApi PHP-SDK.
 * 
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @link http://www.mailwizz.com/
 * @copyright 2013 http://www.mailwizz.com/
 * @license http://www.mailwizz.com/api-client-license/
 */
 
 
/**
 * MailWizzApi_Endpoint_Lists handles all the API calls for lists.
 * 
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @package MailWizzApi
 * @subpackage Endpoint
 * @since 1.0
 */
class MailWizzApi_Endpoint_ListSubscribers extends MailWizzApi_Base
{
	
	/**
	 * List subscribers from a certain mail list
	 * 
	 * @param string $listUid
	 * @param integer $page
	 * @param integer $perPage
	 * @param array $fields 
	 * @return MailWizzApi_Http_Response
	 */
	public function listSubscribers($listUid, $page = 1, $perPage = 10, array $fields = array())
	{
		$client = new MailWizzApi_Http_Client(array(
			'method' 		=> MailWizzApi_Http_Client::METHOD_GET,
			'url' 			=> $this->config->getApiUrl(sprintf('lists/%s/subscribers', $listUid)),
			'paramsGet'		=> array(
				'page'		=> $page, 
				'per_page'	=> $perPage, 
				'fields'	=> $fields
			),
			'getResponseHeaders' => true,
		));
		
		return $response = $client->request();
	}
	
	/**
	 * Subscribe to list
	 * 
	 * @param string $listUid
	 * @param array $data
	 * @return MailWizzApi_Http_Response
	 */
	public function create($listUid, array $data)
	{
		$client = new MailWizzApi_Http_Client(array(
			'method' 		=> MailWizzApi_Http_Client::METHOD_POST,
			'url' 			=> $this->config->getApiUrl(sprintf('lists/%s/subscribers/create', $listUid)),
			'paramsPost'	=> $data,
		));
		
		return $response = $client->request();
	}
	
	/**
	 * Update already subscribed to list
	 * 
	 * @param string $listUid
	 * @param string $subscriberUid
	 * @param array $data
	 * @return MailWizzApi_Http_Response
	 */
	public function update($listUid, $subscriberUid, array $data)
	{
		$client = new MailWizzApi_Http_Client(array(
			'method' 		=> MailWizzApi_Http_Client::METHOD_PUT,
			'url' 			=> $this->config->getApiUrl(sprintf('lists/%s/subscribers/%s/update', $listUid, $subscriberUid)),
			'paramsPut'		=> $data,
		));
		
		return $response = $client->request();
	}
	
	/**
	 * Delete existing subscriber
	 * 
	 * @param string $listUid
	 * @param string $subscriberUid
	 * @return MailWizzApi_Http_Response
	 */
	public function delete($listUid, $subscriberUid)
	{
		$client = new MailWizzApi_Http_Client(array(
			'method' 		=> MailWizzApi_Http_Client::METHOD_DELETE,
			'url' 			=> $this->config->getApiUrl(sprintf('lists/%s/subscribers/%s/delete', $listUid, $subscriberUid)),
			'paramsDelete'	=> array(),
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
	 * Search for a list subscriber by email address
	 * 
	 * @param string $listUid
	 * @param string $emailAddress
	 * @return MailWizzApi_Http_Response
	 */
	public function emailSearch($listUid, $emailAddress)
	{
		$client = new MailWizzApi_Http_Client(array(
			'method' 		=> MailWizzApi_Http_Client::METHOD_GET,
			'url' 			=> $this->config->getApiUrl(sprintf('lists/%s/subscribers/search-by-email', $listUid)),
			'paramsGet'		=> array('EMAIL' => $emailAddress),
		));
		
		return $response = $client->request();
	}
	
	/**
	 * Create or update a subscriber
	 * 
	 * @param string $listUid
	 * @param array $data
	 * @return MailWizzApi_Http_Response
	 */
	public function createUpdate($listUid, $data)
	{
		$emailAddress	= !empty($data['EMAIL']) ? $data['EMAIL'] : null;
		$response		= $this->emailSearch($listUid, $emailAddress);
		
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