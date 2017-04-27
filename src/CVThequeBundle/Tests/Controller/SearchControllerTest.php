<?php

namespace CVThequeBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SearchControllerTest extends WebTestCase
{
    public function testAdvert()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/advert');
    }

    public function testApplicant()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/applicant');
    }

}
