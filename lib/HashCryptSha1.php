<?php
/**
 * @author Viacheslav Lukin <lukin.v.v@gmail.com>
 * @link https://github.com/wlukin/HashCrypt
 * @copyright Copyright &copy; 2013, Viacheslav Lukin
 * @license http://opensource.org/licenses/GPL-2.0 GPLv2
 */

require_once dirname(__FILE__).'/HashCrypt.php';

class HashCryptSha1 extends HashCrypt
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
        return sha1($key.$vector, true);
    }
}