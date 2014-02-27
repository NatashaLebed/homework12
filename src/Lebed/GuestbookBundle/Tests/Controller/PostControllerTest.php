<?php

namespace Lebed\GuestbookBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ru');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Главная")')->count()
        );
    }
}