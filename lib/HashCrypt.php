<?php
/**
 * @author Viacheslav Lukin <lukin.v.v@gmail.com>
 * @link https://github.com/wlukin/HashCrypt
 * @copyright Copyright &copy; 2013, Viacheslav Lukin
 * @license http://opensource.org/licenses/GPL-2.0 GPLv2
 */

abstract class HashCrypt
{
    static private $_instance = array();

    /**
     * Returns the static instance of the specified class.
     * It is provided for invoking class-level methods (something similar to static class methods.)
     * @param string $className class name.
     * @return mixed class instance.
     */
    static public function lib($className)
    {
        if(!isset(self::$_instance[$className])) self::$_instance[$className] = new $className();
        return self::$_instance[$className];
    }

    /**
     * Returns encoded string using CFB mode
     * @param string $data
     * @param string $key
     * @param string $vector
     * @return string
     */
    public function encodeCFB($data, $key, $vector = '')
    {
        $dataLen = strlen($data);
        $output = '';
        $i = 0;
        $vector = $this->_initVector($key, $vector);

        while($i < $dataLen){
            $vector = $this->_makeVector($key, $vector);
            $vectorLength = strlen($vector);
            $block = substr($data, $i, $vectorLength);
            $i += $vectorLength;
            $vector = $vector ^ $block;
            $output .= $vector;
        }

        return $output;
    }

    /**
     * Returns decoded string using CFB mode
     * @param string $data
     * @param string $key
     * @param string $vector
     * @return string
     */
    public function decodeCFB($data, $key, $vector = '')
    {
        $dataLen = strlen($data);
        $output = '';
        $i = 0;
        $vector = $this->_initVector($key, $vector);

        while($i < $dataLen){
            $vector = $this->_makeVector($key, $vector);
            $vectorLength = strlen($vector);
            $block = substr($data, $i, $vectorLength);
            $i += $vectorLength;
            $output .= $block ^ $vector;
            $vector = $block;
        }

        return $output;
    }

    /**
     * Returns encoded string using OFB mode
     * @param string $data
     * @param string $key
     * @param string $vector
     * @return string
     */
    public function encodeOFB($data, $key, $vector = '')
    {
        $dataLen = strlen($data);
        $output = '';
        $i = 0;
        $vector = $this->_initVector($key, $vector);

        while($i < $dataLen){
            $vector = $this->_makeVector($key, $vector);
            $vectorLength = strlen($vector);
            $block = substr($data, $i, $vectorLength);
            $i += $vectorLength;
            $output .= $block ^ $vector;
        }

        return $output;
    }

    /**
     * Returns decoded string using OFB mode
     * @param string $data
     * @param string $key
     * @param string $vector
     * @return string
     */
    public function decodeOFB($data, $key, $vector = '')
    {
        return $this->encodeOFB($data, $key, $vector);
    }

    /**
     * Initialize vector if it's empty
     * @param string $key
     * @param string $vector
     * @return string
     */
    protected function _initVector($key, $vector)
    {
        if($vector == '') $vector = $this->_makeVector($key, '');
        return $vector;
    }

    /**
     * Make new vector using key and vector
     * @param string $key
     * @param string $vector
     * @return string
     */
    abstract protected function _makeVector($key, $vector);
}