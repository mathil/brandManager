<?php

namespace AppBundle\Util;

use Exception;

/**
 * @author mathil <github.com/mathil>
 */
class FileSaver
{

    /**
     * @param $content
     * @param $name
     * @param $baseDir
     * @return bool|string
     */
    public static function createFileAndReturnPath($content, $name, $baseDir): ?string
    {
        self::createDestinationDirIfNotExists($baseDir);
        $destination = $baseDir . $name;
        try {
            file_put_contents($destination, $content);
        } catch (Exception $e) {
            return false;
        }
        return $destination;
    }


    private function createDestinationDirIfNotExists($destination)
    {
        if (false === file_exists($destination)) {
            mkdir($destination);
        }
    }


}