<?php
/**
 * This file contains examples for using the MailWizzApi PHP-SDK.
 *
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @link http://www.mailwizz.com/
 * @copyright 2013-2017 http://www.mailwizz.com/
 */
 
// require the setup which has registered the autoloader
require_once dirname(__FILE__) . '/setup.php';

// CREATE THE ENDPOINT
$endpoint = new MailWizzApi_Endpoint_CampaignBounces();

/*===================================================================================*/

// GET ALL ITEMS
$response = $endpoint->getBounces($campaignUid = 'CAMPAIGN-UNIQUE-ID', $pageNumber = 1, $perPage = 10);

// DISPLAY RESPONSE
echo '<pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// CREATE BOUNCE
$response = $endpoint->create('CAMPAIGN-UNIQUE-ID', array(
    'message'        => 'The reason why this email bounced', // max 250 chars
    'bounce_type'    => 'hard', // hard, soft or internal
    'subscriber_uid' => 'SUBSCRIBER-UNIQUE-ID' // 13 chars unique subscriber identifier
));

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';