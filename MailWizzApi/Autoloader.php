<?php
/**
 * This file contains the autoloader class for the MailWizzApi PHP-SDK.
 *
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @link http://www.mailwizz.com/
 * @copyright 2013-2015 http://www.mailwizz.com/
 */
 
 
/**
 * The MailWizzApi Autoloader class.
 * 
 * From within a Yii Application, you would load this as:
 * 
 * <pre>
 * require_once(Yii::getPathOfAlias('application.vendors.MailWizzApi.Autoloader').'.php');
 * Yii::registerAutoloader(array('MailWizzApi_Autoloader', 'autoloader'), true);
 * </pre>
 * 
 * Alternatively you can:
 * <pre>
 * require_once('Path/To/MailWizzApi/Autoloader.php');
 * MailWizzApi_Autoloader::register();
 * </pre>
 * 
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @package MailWizzApi
 * @since 1.0
 */
class MailWizzApi_Autoloader
{
    /**
     * The registrable autoloader
     * 
     * @param string $class
     */
    public static function autoloader($class)
    {
        if (strpos($class, 'MailWizzApi') === 0) {
            $className = str_replace('_', '/', $class);
            $className = substr($className, 12);
            
            if (is_file($classFile = dirname(__FILE__) . '/'. $className.'.php')) {
                require_once($classFile);
            }
        }
    }
    
    /**
     * Registers the MailWizzApi_Autoloader::autoloader()
     */
    public static function register()
    {
        spl_autoload_register(array('MailWizzApi_Autoloader', 'autoloader'));
    }
}