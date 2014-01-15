<?php
/**
 * @author Viacheslav Lukin <lukin.v.v@gmail.com>
 * @link https://github.com/wlukin/HashCrypt
 * @copyright Copyright &copy; 2013, Viacheslav Lukin
 * @license http://opensource.org/licenses/GPL-2.0 GPLv2
 */

require_once dirname(__FILE__).'/HashCrypt.php';

class HashCryptMd5 extends HashCrypt
{
    /**
     * @return HashCryptMd5 instance
     */
    static public function lib()
    {
        return parent::lib(__CLASS__);
    }

    /**
     * Make new vector using key and vector
     * @param string $key
     * @param string $vector
     * @return string
     */
    protected function _makeVector($key, $vector)
    {
        return md5($key.$vector, true);
    }
}