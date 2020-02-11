<?php

use PHPUnit\Framework\TestCase;

/**
 * Class Base
 */
class MailWizzApi_Test_Base extends TestCase
{
    public function setUp()
    {
        // configuration object
        try {
            MailWizzApi_Base::setConfig(new MailWizzApi_Config(array(
                'apiUrl'     => getenv('MAILWIZZ_API_URL'),
                'publicKey'  => getenv('MAILWIZZ_API_PUBLIC_KEY'),
                'privateKey' => getenv('MAILWIZZ_API_PRIVATE_KEY'),
            )));
        } catch (ReflectionException $e) {
        }
        
        // start UTC
        date_default_timezone_set('UTC');

        parent::setUp();
    }
}
