<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PushSubscriptionControllerTest extends WebTestCase {
    /*
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Go to the list view
        $crawler = $client->request('GET', '/pushsubscription/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /pushsubscription/");

        // Go to the show view
        $crawler = $client->click($crawler->selectLink('show')->link());
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code");
    }

    */

    public function testPushSave() {
        $client = static::createClient();

        $subscription = json_encode(array(
            'endpoint' => 'test',
            'keys' => array(
                'auth' => 'test',
                'p256dh' => 'test'
            )
        ));

        $client->request('POST', '/api/pushsubscription/save', array(
            'subscription' => $subscription,
            'publicKey' => 'BJGSYj7AKNPkzLIwUAO5D8RScwzi1r3QBYv9F3zaccHebz1zEWe-zFxVJZkRnBeIf-_660yucZUDB_lCUqb2zYY'
        ));
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Status code != 200");
    }


}
