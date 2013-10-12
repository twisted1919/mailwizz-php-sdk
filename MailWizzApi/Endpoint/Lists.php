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
	 * List subscribers from a certain mail list
	 * 
	 * @param string $listUid
	 * @param integer $page
	 * @param integer $perPage
	 * @param array $fields 
	 * @return MailWizzApi_Http_Response
	 */
	public function getLists($page = 1, $perPage = 10)
	{
		$client = new MailWizzApi_Http_Client(array(
			'method' 		=> MailWizzApi_Http_Client::METHOD_GET,
			'url' 			=> $this->config->getApiUrl('lists'),
			'paramsGet'		=> array(
				'page'		=> $page, 
				'per_page'	=> $perPage
			),
			'getResponseHeaders' => true,
		));
		
		return $response = $client->request();
	}
}