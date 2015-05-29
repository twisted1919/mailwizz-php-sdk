<?php
/**
 * This file contains the File cache class used in the MailWizzApi PHP-SDK.
 * 
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @link http://www.mailwizz.com/
 * @copyright 2013-2015 http://www.mailwizz.com/
 */
 
 
/**
 * MailWizzApi_Cache_File makes use of the file system in order to cache data.
 * 
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 * @package MailWizzApi
 * @subpackage Cache
 * @since 1.0
 */
class MailWizzApi_Cache_File extends MailWizzApi_Cache_Abstract
{
    /**
     * @var string the path to the directory where the cache files will be stored.
     * 
     * Please note, the cache directory needs to be writable by the web server (chmod 0777).
     * 
     * Defaults to data/cache under same directory.
     */
    private $_filesPath;

    /**
     * Cache data by given key.
     * 
     * For consistency, the key will go through sha1() before it is saved.
     * 
     * This method implements {@link MailWizzApi_Cache_Abstract::set()}.
     * 
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public function set($key, $value)
    {
        $value = serialize($value);
        if ($exists = $this->get($key)) {
            if ($value === serialize($exists)) {
                return true;
            }
        }
        $key = sha1($key);
        return @file_put_contents($this->getFilesPath() . '/' . $key.'.bin', $value);
    }
    
    /**
     * Get cached data by given key.
     * 
     * For consistency, the key will go through sha1() 
     * before it will be used to retrieve the cached data.
     * 
     * This method implements {@link MailWizzApi_Cache_Abstract::get()}.
     * 
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        $key = sha1($key);
        
        if (isset($this->_loaded[$key])) {
            return $this->_loaded[$key];
        }
        
        if (!is_file($file = $this->getFilesPath() . '/' . $key.'.bin')) {
            return $this->_loaded[$key] = null;
        }
        
        return $this->_loaded[$key] = unserialize(file_get_contents($file));    
    }
    
    /**
     * Delete cached data by given key.
     * 
     * For consistency, the key will go through sha1() 
     * before it will be used to delete the cached data.
     * 
     * This method implements {@link MailWizzApi_Cache_Abstract::delete()}.
     * 
     * @param string $key
     * @return bool
     */
    public function delete($key)
    {
        $key = sha1($key);
        
        if (isset($this->_loaded[$key])) {
            unset($this->_loaded[$key]);
        }
        
        if (is_file($file = $this->getFilesPath() . '/' . $key.'.bin')) {
            @unlink($file);
            return true;
        }
        
        return false;
    }
    
    /**
     * Delete all cached data.
     * 
     * This method implements {@link MailWizzApi_Cache_Abstract::flush()}.
     * 
     * @return bool
     */
    public function flush()
    {
        $this->_loaded = array();
        return $this->doFlush($this->getFilesPath());
    }
    
    /**
     * Set the cache path.
     * 
     * @param string the path to the directory that will store the files
     * @return MailWizzApi_Cache_File
     */
    public function setFilesPath($path)
    {
        if (file_exists($path) && is_dir($path)) {
            $this->_filesPath = $path;
        }
        return $this;
    }
    
    /**
     * Get the cache path. 
     * 
     * It defaults to "data/cache" under the same directory.
     * 
     * Please make sure the given directoy is writable by the webserver(chmod 0777).
     * 
     * @return string
     */
    public function getFilesPath()
    {
        if (empty($this->_filesPath)) {
            $this->_filesPath = dirname(__FILE__) . '/data/cache';
        }
        return $this->_filesPath;
    }
    
    /**
     * Helper method to clear the cache directory contents
     * 
     * @param string $path
     * @return bool
     */
    protected function doFlush($path)
    {
        if (!file_exists($path) || !is_dir($path)) {
            return false;
        }
        
        if (($handle = opendir($path)) === false) {
            return false;
        }
        
        while (($file = readdir($handle)) !== false) {
            
            if($file[0] === '.') {
                continue;
            }
            
            $fullPath=$path.DIRECTORY_SEPARATOR.$file;
            
            if(is_dir($fullPath)) {
                $this->doFlush($fullPath);
            } else {
                @unlink($fullPath);
            }
        }
        
        closedir($handle);
        return true;
    }
}