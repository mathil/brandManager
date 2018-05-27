<?php

namespace AppBundle\Listener;

use AppBundle\Service\RedisAdapter;
use Exception;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Yaml\Yaml;


/**
 * @author mathil <github.com/mathil>
 */
class ModulesInjector
{

    const MODULES_CONFIG = __DIR__.'/../../../app/config/modules.yml';

    /**
     * @var Session
     */
    private $session;

    /**
     * @var RedisAdapter
     */
    private $redisAdapter;


    /**
     * @param Session $session
     * @param RedisAdapter $redisAdapter
     */
    public function __construct(Session $session, RedisAdapter $redisAdapter)
    {
        $this->session = $session;
        $this->redisAdapter = $redisAdapter;
    }


    /**
     * @throws Exception
     */
    public function onKernelRequest(): void
    {
        $modules = $this->redisAdapter->get('bm_modules');
        if (null !== $modules) {
            $this->session->set('modules', json_decode($modules, true));

            return;
        }

        if (false === file_exists(self::MODULES_CONFIG)) {
            throw new Exception('Modules config files doesn\'t exists');
        }
        $configFile = file_get_contents(self::MODULES_CONFIG);
        $modules = Yaml::parse($configFile);
        $this->redisAdapter->set('bm_modules', json_encode($modules));

        $this->session->set('modules', $modules);
    }

}
