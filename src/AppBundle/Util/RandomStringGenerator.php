<?php

namespace AppBundle\Util;

class RandomStringGenerator {

    public static function generateString($length) {
        $chars = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789!@#$%^&*';
        $result = "";
        for ($i = 0; $i <= $length; $i++) {
            $result .= $chars[rand(0, strlen($chars))];
        }
        return $result;
    }

}
