<?php

namespace AppBundle\Util;

class RandomStringGenerator
{

    public static function generateString(int $length, bool $onlyAlphanumeric = false): string
    {
        $chars = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789';
        if (false === $onlyAlphanumeric) {
            $chars .= '!@#$%^&*';
        }
        $result = "";
        $randMax = strlen($chars) -1;
        for ($i = 0; $i < $length; $i++) {
            $result .= $chars[rand(0, $randMax)];
        }
        return $result;
    }

}
