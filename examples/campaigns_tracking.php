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

// PLEASE NOTE THAT THIS ENDPOINT ONLY WORKS WITH MAILWIZZ >= 1.3.7.3
// CREATE THE ENDPOINT
$endpoint = new MailWizzApi_Endpoint_CampaignsTracking();

/*===================================================================================*/

// Track subscriber click for campaign click
$response = $endpoint->trackUrl('CAMPAIGN-UNIQUE-ID', 'SUBSCRIBER-UNIQUE-ID', 'URL-HASH');

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// Track subscriber open for campaign
$response = $endpoint->trackOpening('CAMPAIGN-UNIQUE-ID', 'SUBSCRIBER-UNIQUE-ID');

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// Track subscriber unsubscribe for campaign
$response = $endpoint->trackUnsubscribe('CAMPAIGN-UNIQUE-ID', 'SUBSCRIBER-UNIQUE-ID', array(
    'ip_address' => '123.123.123.123',
    'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36',
    'reason'     => 'Reason for unsubscribe!',
));

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';