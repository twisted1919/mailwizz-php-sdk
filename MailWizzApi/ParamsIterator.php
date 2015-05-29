<?php
/**
 * CMapIterator class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * CMapIterator implements an iterator for {@link CMap}.
 *
 * It allows CMap to return a new iterator for traversing the items in the map.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.collections
 * @since 1.0
 */

/**
 * MailWizzApi_ParamsIterator implements an interator for {@link MailWizzApi_Params}.
 *
 * It allows MailWizzApi_Params to return a new iterator for traversing the items in the map.
 * 
 * @author Serban George Cristian
 * @link http://www.mailwizz.com
 * @copyright 2013-2015 http://www.mailwizz.com/
 * @package MailWizzApi
 * @since 1.0
 * 
 * Implementation based on CMapIterator class file from the Yii framework.
 * Please see /license/yiiframework.txt file for license info.
 */
class MailWizzApi_ParamsIterator implements Iterator
{
	/**
	 * @var array the data to be iterated through
	 */
	private $_data;
	
	/**
	 * @var array list of keys in the map
	 */
	private $_keys;
	
	/**
	 * @var mixed current key
	 */
	private $_key;

	/**
	 * Constructor.
	 * @param array $data the data to be iterated through
	 */
	public function __construct(&$data)
	{
		$this->_data =& $data;
		$this->_keys = array_keys($data);
		$this->_key = reset($this->_keys);
	}

	/**
	 * Rewinds internal array pointer.
	 * This method is required by the interface Iterator.
	 */
	public function rewind()
	{
		$this->_key = reset($this->_keys);
	}

	/**
	 * Returns the key of the current array element.
	 * This method is required by the interface Iterator.
	 * @return mixed the key of the current array element
	 */
	public function key()
	{
		return $this->_key;
	}

	/**
	 * Returns the current array element.
	 * This method is required by the interface Iterator.
	 * @return mixed the current array element
	 */
	public function current()
	{
		return $this->_data[$this->_key];
	}

	/**
	 * Moves the internal pointer to the next array element.
	 * This method is required by the interface Iterator.
	 */
	public function next()
	{
		$this->_key = next($this->_keys);
	}

	/**
	 * Returns whether there is an element at current position.
	 * This method is required by the interface Iterator.
	 * @return boolean
	 */
	public function valid()
	{
		return $this->_key !== false;
	}
}