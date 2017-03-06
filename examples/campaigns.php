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
    'name'          => 'My API Campaign', // required
    'type'          => 'regular', // optional: regular or autoresponder
    'from_name'     => 'John Doe', // required
    'from_email'    => 'john.doe@doe.com', // required
    'subject'       => 'Hey, i am testing the campaigns via API', // required
    'reply_to'      => 'john.doe@doe.com', // required
    'send_at'       => date('Y-m-d H:i:s', strtotime('+10 hours')), // required, this will use the timezone which customer selected
    'list_uid'      => 'LIST-UNIQUE-ID', // required
    'segment_uid'   => 'SEGMENT-UNIQUE-ID',// optional, only to narrow down
    
    // optional block, defaults are shown
    'options' => array(
        'url_tracking'      => 'no', // yes | no 
        'json_feed'         => 'no', // yes | no 
        'xml_feed'          => 'no', // yes | no  
        'plain_text_email'  => 'yes',// yes | no 
        'email_stats'       => null, // a valid email address where we should send the stats after campaign done
        
        // - if autoresponder uncomment bellow:
        //'autoresponder_event'            => 'AFTER-SUBSCRIBE', // AFTER-SUBSCRIBE or AFTER-CAMPAIGN-OPEN
        //'autoresponder_time_unit'        => 'hour', // minute, hour, day, week, month, year
        //'autoresponder_time_value'       => 1, // 1 hour after event
        //'autoresponder_open_campaign_id' => 1, // INT id of campaign, only if event is AFTER-CAMPAIGN-OPEN,
        
        // - if this campaign is advanced recurring, you can set a cron job style frequency.
        // - please note that this applies only for regular campaigns.
        //'cronjob'         => '0 0 * * *', // once a day
        //'cronjob_enabled' => 1, // 1 or 0
    ),
    
    // required block, archive or template_uid or content => required.
    'template' => array(
        //'archive'         => file_get_contents(dirname(__FILE__) . '/template-example.zip'),
        //'template_uid'    => 'TEMPLATE-UNIQUE-ID',
        'content'           => file_get_contents(dirname(__FILE__) . '/template-example.html'),
        'inline_css'        => 'no', // yes | no
        'plain_text'        => null, // leave empty to auto generate
        'auto_plain_text'   => 'yes', // yes | no
    ),
));

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// UPDATE CAMPAIGN
$response = $endpoint->update('CAMPAIGN-UNIQUE-ID', array(
    'name'          => 'My API Campaign UPDATED', // optional at update
    'from_name'     => 'John Doe', // optional at update
    'from_email'    => 'john.doe@doe.com', // optional at update
    'subject'       => 'Hey, i am testing the campaigns via API', // optional at update
    'reply_to'      => 'john.doe@doe.com', // optional at update
    'send_at'       => date('Y-m-d H:i:s', strtotime('+1 hour')), //optional at update, this will use the timezone which customer selected
    'list_uid'      => 'LIST-UNIQUE-ID', // optional at update
    'segment_uid'   => 'SEGMENT-UNIQUE-ID',// optional, only to narrow down
    
    // optional block, defaults are shown
    'options' => array(
        'url_tracking'      => 'no', // yes | no 
        'json_feed'         => 'no', // yes | no 
        'xml_feed'          => 'no', // yes | no  
        'plain_text_email'  => 'yes',// yes | no 
        'email_stats'       => null, // a valid email address where we should send the stats after campaign done
    ),
    
    // optional block at update, archive or template_uid or content => required.
    'template' => array(
        //'archive'         => file_get_contents(dirname(__FILE__) . '/template-example.zip'),
        //'template_uid'    => 'TEMPLATE-UNIQUE-ID',
        'content'           => file_get_contents(dirname(__FILE__) . '/template-example.html'),
        'inline_css'        => 'no', // yes | no
        'plain_text'        => null, // leave empty to auto generate
        'auto_plain_text'   => 'yes', // yes | no
    ),
));

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// Copy CAMPAIGN
$response = $endpoint->copy('CAMPAIGN-UNIQUE-ID');

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// Pause/Unpause CAMPAIGN
$response = $endpoint->pauseUnpause('CAMPAIGN-UNIQUE-ID');

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// Mark CAMPAIGN as sent
$response = $endpoint->markSent('CAMPAIGN-UNIQUE-ID');

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