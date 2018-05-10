<?php

namespace AppBundle\Service;


/**
 * @author mathil <github.com/mathil>
 */
class RedisAdapter
{

    /**
     * @var \Symfony\Component\Cache\Adapter\RedisAdapter;
     */
    private $redisAdapter;

    public function __construct(string $host, string $port)
    {
        $this->redisAdapter = \Symfony\Component\Cache\Adapter\RedisAdapter::createConnection('redis://' . $host . ':' . $port);
    }

    public function set(string $key, string $value)
    {
        $this->redisAdapter->set($key, $value);
    }

    public function get(string $key)
    {
        return $this->redisAdapter->get($key);
    }

}