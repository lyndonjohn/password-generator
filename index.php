<?php

/**
 *  Author: Lyndon John Vergara
 *  Date/Time Created: 2019-10-07 00:15:41
 *  File Description: Password Generator
 */

function randomToken($length = 18)
{
    if (function_exists('random_bytes')) {
        return bin2hex(random_bytes($length));
    }

    if (function_exists('mcrypt_create_iv')) {
        return bin2hex(mcrypt_create_iv($length, MCRYPT_DEV_URANDOM));
    }

    if (function_exists('openssl_random_pseudo_bytes')) {
        return bin2hex(openssl_random_pseudo_bytes($length));
    }
}

function salt()
{
    return substr(strtr(base64_encode(hex2bin(randomToken())), '+', '.'), 0, 44);
}

function hyphenate($string)
{
    return implode("-", str_split($string, 6));
}

$password = hyphenate(mb_substr((salt()), 0, 18));

echo $password;
/**
 * Sample output:
 *      GUZvMr-M/H7.X-j1uKc.
 *      mM7paD-AD4I93-p/qKTJ
 *      Ot9jcH-aKuKzd-k9Fgvp
 */
