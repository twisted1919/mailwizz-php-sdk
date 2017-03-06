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
$endpoint = new MailWizzApi_Endpoint_ListSubscribers();

/*===================================================================================*/

// GET ALL ITEMS
$response = $endpoint->getSubscribers('LIST-UNIQUE-ID', $pageNumber = 1, $perPage = 10);

// DISPLAY RESPONSE
echo '<pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// GET ONE ITEM
$response = $endpoint->getSubscriber('LIST-UNIQUE-ID', 'SUBSCRIBER-UNIQUE-ID');

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// SEARCH BY EMAIL
$response = $endpoint->emailSearch('LIST-UNIQUE-ID', 'john.doe@doe.com');

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// SEARCH BY EMAIL IN ALL LISTS
$response = $endpoint->emailSearchAllLists('john.doe@doe.com');

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// ADD SUBSCRIBER
$response = $endpoint->create('LIST-UNIQUE-ID', array(
    'EMAIL'    => 'john.doe@doe.com', // the confirmation email will be sent!!! Use valid email address
    'FNAME'    => 'John',
    'LNAME'    => 'Doe'
));

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';


/*===================================================================================*/

// UPDATE EXISTING SUBSCRIBER
$response = $endpoint->update('LIST-UNIQUE-ID', 'SUBSCRIBER-UNIQUE-ID', array(
    'EMAIL'    => 'john.doe@doe.com',
    'FNAME'    => 'John',
    'LNAME'    => 'Doe Updated'
));

// DISPLAY RESPONSE
echo '<hr />';
echo '<pre>';
print_r($response->body);

/*===================================================================================*/

// CREATE / UPDATE EXISTING SUBSCRIBER
$response = $endpoint->createUpdate('LIST-UNIQUE-ID', array(
    'EMAIL'    => 'john.doe@doe.com',
    'FNAME'    => 'John',
    'LNAME'    => 'Doe Updated Second time'
));

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// UNSUBSCRIBE existing subscriber, no email is sent, unsubscribe is silent
$response = $endpoint->unsubscribe('LIST-UNIQUE-ID', 'SUBSCRIBER-UNIQUE-ID');

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';

/*===================================================================================*/

// UNSUBSCRIBE existing subscriber by email address, no email is sent, unsubscribe is silent
$response = $endpoint->unsubscribeByEmail('LIST-UNIQUE-ID', 'john@doe.com');

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';
/*===================================================================================*/

// DELETE SUBSCRIBER, no email is sent, delete is silent
$response = $endpoint->delete('LIST-UNIQUE-ID', 'SUBSCRIBER-UNIQUE-ID');

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';
/*===================================================================================*/

// DELETE SUBSCRIBER by email address, no email is sent, delete is silent
$response = $endpoint->deleteByEmail('LIST-UNIQUE-ID', 'john@doe.com');

// DISPLAY RESPONSE
echo '<hr /><pre>';
print_r($response->body);
echo '</pre>';
