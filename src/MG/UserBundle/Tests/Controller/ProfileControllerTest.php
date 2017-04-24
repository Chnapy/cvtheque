<?php

namespace MG\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfileControllerTest extends WebTestCase
{
    public function testVisite()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/profile/{slug}');
    }

    public function testEdit(){

    	$client = static::createClient();

    	$crawler = $client->request("GET", '/profile/{slug}');

    	



    }

}
