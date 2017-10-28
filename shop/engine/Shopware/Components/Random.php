<?php
/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */

namespace Shopware\Components;

/**
 * Pseudorandom number generator (PRNG).
 *
 * This class is highly based on Rand.php of Component_ZendMath
 *
 * @category  Shopware
 *
 * @see      https://github.com/zendframework/zf2/blob/master/library/Zend/Math/Rand.php
 * @see      https://github.com/ircmaxell/RandomLib
 *
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://opensource.org/licenses/bsd-license.php New BSD License
 */
abstract class Random
{
    /**
     * Generate random bytes
     *
     * @param int $length
     *
     * @throws \Exception
     *
     * @return string
     */
    public static function getBytes($length)
    {
        if ($length <= 0) {
            return false;
        }

        return random_bytes($length);
    }

    /**
     * Generate random boolean
     *
     * @return bool
     */
    public static function getBoolean()
    {
        $byte = static::getBytes(1);

        return (bool) (ord($byte) % 2);
    }

    /**
     * Generate a random integer between $min and $max inclusive
     *
     * @param int $min
     * @param int $max
     *
     * @throws \DomainException
     *
     * @return int
     */
    public static function getInteger($min, $max)
    {
        if ($min > $max) {
            throw new \DomainException(
                'The min parameter must be lower than max parameter'
            );
        }

        return random_int($min, $max);
    }

    /**
     * Generate random float (0..1)
     * This function generates floats with platform-dependent precision
     *
     * PHP uses double precision floating-point format (64-bit) which has
     * 52-bits of significand precision. We gather 7 bytes of random data,
     * and we fix the exponent to the bias (1023). In this way we generate
     * a float of 1.mantissa.
     *
     * @return float
     */
    public static function getFloat()
    {
        $bytes = static::getBytes(7);
        $bytes[6] = $bytes[6] | chr(0xF0);
        $bytes .= chr(63); // exponent bias (1023)
        list(, $float) = unpack('d', $bytes);

        return $float - 1;
    }

    /**
     * Generate a random string of specified length.
     *
     * Uses supplied character list for generating the new string.
     * If no character list provided - uses Base 64 character set.
     *
     * @param int         $length
     * @param string|null $charlist
     *
     * @throws \DomainException
     *
     * @return string
     */
    public static function getString($length, $charlist = null)
    {
        if ($length < 1) {
            throw new \DomainException('Length should be >= 1');
        }

        // charlist is empty or not provided
        if (empty($charlist)) {
            $numBytes = ceil($length * 0.75);
            $bytes = static::getBytes($numBytes);

            return mb_substr(rtrim(base64_encode($bytes), '='), 0, $length, '8bit');
        }

        $listLen = mb_strlen($charlist, '8bit');

        if ($listLen == 1) {
            return str_repeat($charlist, $length);
        }

        $result = '';
        for ($i = 0; $i < $length; ++$i) {
            $pos = static::getInteger(0, $listLen - 1);
            $result .= $charlist[$pos];
        }

        return $result;
    }

    /**
     * Generate a random alphanumeric string of specified length.
     *
     * Charlist: a-zA-Z0-9
     *
     * @param int $length
     *
     * @throws \DomainException
     *
     * @return string
     */
    public static function getAlphanumericString($length)
    {
        if ($length < 1) {
            throw new \DomainException('Length should be >= 1');
        }

        $charlist = implode(range('a', 'z')) . implode(range('A', 'Z')) . implode(range(0, 9));

        return static::getString($length, $charlist);
    }
}
