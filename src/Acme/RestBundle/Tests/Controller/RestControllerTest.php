<?php

namespace Acme\RestBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RestControllerTest extends WebTestCase
{
    public function testGetArticles()
    {
        $client = $this->createClient();

        $crawler = $client->request('GET', '/api/rest/articles');
        $this->assertTrue($crawler->filter('html:contains("bim")')->count() > 0);

        $client->request('GET', '/api/rest/articles.json');
        $response = $client->getResponse();
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('{"articles":[{"name":"bim"},{"name":"bam"},{"name":"bingo"}],"page":"1"}', $response->getContent());

        $client->request('GET', '/api/rest/articles', array(), array(), array('HTTP_ACCEPT' => 'application/json'));
        $response = $client->getResponse();
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('{"articles":[{"name":"bim"},{"name":"bam"},{"name":"bingo"}],"page":"1"}', $response->getContent());

        $client->request('GET', '/api/rest/articles.xml');
        $response = $client->getResponse();
        $this->assertTrue($response->isSuccessful());
    }

    public function testGetArticle()
    {
        $client = $this->createClient();

        $crawler = $client->request('GET', '/api/rest/articles/bim');

        $this->assertTrue($crawler->filter('html:contains("bim")')->count() > 0);
    }

    public function testGetNewArticle()
    {
        $client = $this->createClient();

        $crawler = $client->request('GET', '/api/rest/articles/new');
        $response = $client->getResponse();
        $this->assertTrue($response->isSuccessful());

        $client->request('GET', '/api/rest/articles/new.json');
        $response = $client->getResponse();
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('{"children":{"id":[],"name":[],"content":[]}}', $response->getContent());

        $client->request('GET', '/api/rest/articles/new', array(), array(), array('HTTP_ACCEPT' => 'application/json'));
        $response = $client->getResponse();
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('{"children":{"id":[],"name":[],"content":[]}}', $response->getContent());

        $client->request('GET', '/api/rest/articles/new.xml');
        $response = $client->getResponse();
        $this->assertTrue($response->isSuccessful());
    }
}
