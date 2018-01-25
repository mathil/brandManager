<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PushSubscriptionControllerTest extends WebTestCase
{

    private $client;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->client = static::createClient();
        $this->login();
    }

    public function login()
    {
        $crawler = $this->client->request('GET', '/login');
        $buttonCrawlerNode = $crawler->selectButton('Zaloguj');
        $form = $buttonCrawlerNode->form();
        $data = ['_username' => 'mathil', '_password' => 'mathil'];
        $this->client->submit($form, $data);
        $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testIndex()
    {
        $this->client->request('GET', '/pushsubscription/list');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /");
    }


}
