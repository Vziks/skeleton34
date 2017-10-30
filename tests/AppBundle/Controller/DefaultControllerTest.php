<?php

namespace Tests\AppBundle\Controller;

//use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('deny', $client->getResponse()->headers->get('X-Frame-Options'), '', 0.0, 10, false, true);
        $this->assertEquals('nosniff', $client->getResponse()->headers->get('X-Content-Type-Options'), '', 0.0, 10, false, true);

        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }
}
