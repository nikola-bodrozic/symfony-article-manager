<?php

namespace MyCompany\ArticleBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReportControllerTest extends WebTestCase
{
    public function testUpdatedevents()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/articles/report/recentlyUpdated.csv');
    }

}
