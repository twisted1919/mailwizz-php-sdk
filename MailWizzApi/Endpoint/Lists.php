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
class MailWizzApi_Endpoint_Lists extends MailWizzApi_Base
{
	/**
	 * Get all the mail list of the current customer
	 * 
	 * Note, the results returned by this endpoint can be cached.
	 * 
	 * @param integer $page
	 * @param integer $perPage
	 * @return MailWizzApi_Http_Response
	 */
	public function getLists($page = 1, $perPage = 10)
	{
		$client = new MailWizzApi_Http_Client(array(
			'method' 		=> MailWizzApi_Http_Client::METHOD_GET,
			'url' 			=> $this->config->getApiUrl('lists'),
			'paramsGet'		=> array(
				'page'		=> (int)$page, 
				'per_page'	=> (int)$perPage
			),
			'getResponseHeaders' => true,
		));
		
		return $response = $client->request();
	}
}