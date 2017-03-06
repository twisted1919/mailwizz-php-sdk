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

// create the lists endpoint:
$endpoint = new MailWizzApi_Endpoint_Lists();

// create a new list
// please see countries.php example file for a list of allowed countries/zones for list company
$response = $endpoint->create(array(
    // required
    'general' => array(
        'name'          => 'My list created from the API', // required
        'description'   => 'This is a test list, created from the API.', // required
    ),
    // required
    'defaults' => array(
        'from_name' => 'John Doe', // required
        'from_email'=> 'johndoe@doe.com', // required
        'reply_to'  => 'johndoe@doe.com', // required
        'subject'   => 'Hello!',
    ),
    // optional
    'notifications' => array(
        // notification when new subscriber added
        'subscribe'         => 'yes', // yes|no
        // notification when subscriber unsubscribes
        'unsubscribe'       => 'yes', // yes|no
        // where to send the notifications.
        'subscribe_to'      => 'johndoe@doe.com',
        'unsubscribe_to'    => 'johndoe@doe.com',
    ),
    // optional, if not set customer company data will be used
    'company' => array(
        'name'      => 'John Doe INC', // required
        'country'   => 'United States', // required
        'zone'      => 'New York', // required
        'address_1' => 'Some street address', // required
        'address_2' => '',
        'zone_name' => '', // when country doesn't have required zone.
        'city'      => 'New York City',
        'zip_code'  => '10019',
    ),
));

// and get the response
echo '<pre>';
print_r($response->body);
echo '</pre>';
