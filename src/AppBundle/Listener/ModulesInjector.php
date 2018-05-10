<?php

namespace AppBundle\Listener;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Yaml\Yaml;


/**
 * @author mathil <github.com/mathil>
 */
class ModulesInjector
{

    const MODULES_CONFIG = __DIR__ . '/../../../app/config/modules.yml';

    /**
     * @var Session
     */
    private $session;


    /**
     * @param $session
     */
    public function __construct($session)
    {
        $this->session = $session;
    }


    public function onKernelRequest()
    {
//        if ($this->session->get('modules') === null) {
            if (false === file_exists(self::MODULES_CONFIG)) {
                throw new \Exception('Modules config files doesn\'t exists');
            }
            $configFile = file_get_contents(self::MODULES_CONFIG);
            $modules = Yaml::parse($configFile);
            $this->session->set('modules', $modules);
//        }
    }

}
