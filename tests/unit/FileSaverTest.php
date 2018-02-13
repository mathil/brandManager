<?php


use AppBundle\Util\FileSaver;
use Symfony\Component\Yaml\Yaml;

class FileSaverTest extends \Codeception\Test\Unit
{

    protected function _before()
    {

    }


    public function testCreateFileAndReturnPath()
    {
        $content = 'content';
        $filename = 'text.txt';
        $path = $this->getDestinationPath();
        $result = FileSaver::createFileAndReturnPath($content, $filename, $path);
        $fileExists = file_exists($path . $filename);
        $this->assertEquals($path . $filename, $result);
        if ($fileExists) {
            unlink($path . $filename);
        }


    }

    private function getDestinationPath()
    {
        $parameters = file_get_contents(__DIR__ . '/../../app/config/parameters.yml');
        $content = Yaml::parse($parameters);
        return $content['parameters']['temp_files_dir'];
    }


}