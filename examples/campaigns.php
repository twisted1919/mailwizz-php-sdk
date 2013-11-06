<?php
/**
 * This file contains examples for using the MailWizzApi PHP-SDK.
 *
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @link http://www.mailwizz.com/
 * @copyright 2013 http://www.mailwizz.com/
 */
 
// require the setup which has registered the autoloader
require_once dirname(__FILE__) . '/setup.php';

// CREATE THE ENDPOINT
$endpoint = new MailWizzApi_Endpoint_Campaigns();

/*===================================================================================*/

// GET ALL ITEMS
$response = $endpoint->getCampaigns($pageNumber = 1, $perPage = 10);

// DISPLAY RESPONSE
echo '<pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// GET ONE ITEM
$response = $endpoint->getCampaign('CAMPAIGN-UNIQUE-ID');

// DISPLAY RESPONSE
echo '<pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// CREATE CAMPAIGN
$response = $endpoint->create(array(
    'name'          => 'My API Campaign',
    'from_name'     => 'John Doe',
    'subject'       => 'Hey, i am testing the campaigns via API',
    'reply_to'      => 'john.doe@doe.com',
    'send_at'       => date('Y-m-d H:i:s', strtotime('+1 hour')), // this will use the timezone which customer selected
    'list_uid'      => 'LIST-UNIQUE-ID',
    'segment_uid'   => 'SEGMENT-UNIQUE-ID',// optional, only to narrow down
    // 'template_uid'    => '', // use existing template, provide the UNIQUE ID or:
    'template'      => array(
        'content'   => file_get_contents(dirname(__FILE__) . '/template-example.html'),
        'inline_css'=> 'no', // valid options: yes/no
    ),
));

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// UPDATE CAMPAIGN
$response = $endpoint->update('CAMPAIGN-UNIQUE-ID', array(
    'name'          => 'My API Campaign UPDATED',
    'from_name'     => 'John Doe',
    'subject'       => 'Hey, i am testing the campaigns via API',
    'reply_to'      => 'john.doe@doe.com',
    'send_at'       => date('Y-m-d H:i:s', strtotime('+1 hour')), // this will use the timezone which customer selected
    'list_uid'      => 'LIST-UNIQUE-ID',
    'segment_uid'   => 'SEGMENT-UNIQUE-ID',// optional, only to narrow down
    // 'template_uid'    => '', // use existing template, provide the UNIQUE ID or:
    'template'      => array(
        'content'   => file_get_contents(dirname(__FILE__) . '/template-example.html'),
        'inline_css'=> 'no', // yes|no
    ),
));

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// Delete CAMPAIGN
$response = $endpoint->delete('CAMPAIGN-UNIQUE-ID');

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';