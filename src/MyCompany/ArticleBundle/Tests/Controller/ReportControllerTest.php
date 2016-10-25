<?php

namespace MyCompany\ArticleBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReportControllerTest extends WebTestCase
{
    public function testDumpArticlesInFile()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/articles/report/recentlyUpdated.csv');

        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "/articles/report/recentlyUpdated.csv");
    }

}
