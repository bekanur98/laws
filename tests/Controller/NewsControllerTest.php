<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NewsControllerTest extends WebTestCase
{
    public function testNewsCreate(): void
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/news/add', [
            'title_news' => 'Title of News',
            'body_news' => 'Content of News'
        ]);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
