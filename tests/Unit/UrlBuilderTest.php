<?php

namespace CodeZero\UrlBuilder\Tests\Unit;

use CodeZero\UrlBuilder\Tests\TestCase;
use CodeZero\UrlBuilder\UrlBuilder;

class UrlBuilderTest extends TestCase
{
    /** @test */
    public function it_builds_a_url()
    {
        $urlBuilder = new UrlBuilder('http://www.example.com:8000/abc/def?ref=testcase&foo=bar');

        $this->assertEquals('http://www.example.com:8000/abc/def?ref=testcase&foo=bar', $urlBuilder->build());
        $this->assertEquals('/abc/def?ref=testcase&foo=bar', $urlBuilder->build(false));
    }

    /** @test */
    public function it_gets_url_parts()
    {
        $urlBuilder = new UrlBuilder('http://www.example.com:8000/abc/def?ref=testcase&foo=bar');

        $this->assertEquals('http', $urlBuilder->getScheme());
        $this->assertEquals('www.example.com', $urlBuilder->getHost());
        $this->assertEquals('8000', $urlBuilder->getPort());
        $this->assertEquals('/abc/def', $urlBuilder->getPath());
        $this->assertEquals(['abc', 'def'], $urlBuilder->getSlugs());
        $this->assertEquals('ref=testcase&foo=bar', $urlBuilder->getQueryString());
        $this->assertEquals(['ref' => 'testcase', 'foo' => 'bar'], $urlBuilder->getQuery());
    }

    /** @test */
    public function it_sets_the_scheme()
    {
        $urlBuilder = new UrlBuilder('http://www.example.com:8000/abc/def?ref=testcase&foo=bar');

        $urlBuilder->setScheme('https');

        $this->assertEquals('https', $urlBuilder->getScheme());
        $this->assertEquals('https://www.example.com:8000/abc/def?ref=testcase&foo=bar', $urlBuilder->build());
        $this->assertEquals('/abc/def?ref=testcase&foo=bar', $urlBuilder->build(false));
    }

    /** @test */
    public function it_sets_the_host()
    {
        $urlBuilder = new UrlBuilder('http://www.example.com:8000/abc/def?ref=testcase&foo=bar');

        $urlBuilder->setHost('example.test');

        $this->assertEquals('example.test', $urlBuilder->getHost());
        $this->assertEquals('http://example.test:8000/abc/def?ref=testcase&foo=bar', $urlBuilder->build());
        $this->assertEquals('/abc/def?ref=testcase&foo=bar', $urlBuilder->build(false));
    }

    /** @test */
    public function it_sets_the_port()
    {
        $urlBuilder = new UrlBuilder('http://www.example.com:8000/abc/def?ref=testcase&foo=bar');

        $urlBuilder->setPort(8080);

        $this->assertEquals('8080', $urlBuilder->getPort());
        $this->assertEquals('http://www.example.com:8080/abc/def?ref=testcase&foo=bar', $urlBuilder->build());
        $this->assertEquals('/abc/def?ref=testcase&foo=bar', $urlBuilder->build(false));

        $urlBuilder->setPort(null);

        $this->assertEquals('', $urlBuilder->getPort());
        $this->assertEquals('http://www.example.com/abc/def?ref=testcase&foo=bar', $urlBuilder->build());
        $this->assertEquals('/abc/def?ref=testcase&foo=bar', $urlBuilder->build(false));
    }

    /** @test */
    public function it_sets_the_path()
    {
        $urlBuilder = new UrlBuilder('http://www.example.com:8000/abc/def?ref=testcase&foo=bar');

        $urlBuilder->setPath('lorem/ipsum');

        $this->assertEquals('/lorem/ipsum', $urlBuilder->getPath());
        $this->assertEquals(['lorem', 'ipsum'], $urlBuilder->getSlugs());
        $this->assertEquals('http://www.example.com:8000/lorem/ipsum?ref=testcase&foo=bar', $urlBuilder->build());
        $this->assertEquals('/lorem/ipsum?ref=testcase&foo=bar', $urlBuilder->build(false));

        $urlBuilder->setPath('/lorem/ipsum');

        $this->assertEquals('/lorem/ipsum', $urlBuilder->getPath());
        $this->assertEquals(['lorem', 'ipsum'], $urlBuilder->getSlugs());
        $this->assertEquals('http://www.example.com:8000/lorem/ipsum?ref=testcase&foo=bar', $urlBuilder->build());
        $this->assertEquals('/lorem/ipsum?ref=testcase&foo=bar', $urlBuilder->build(false));

        $urlBuilder->setPath('/');

        $this->assertEquals('/', $urlBuilder->getPath());
        $this->assertEquals([], $urlBuilder->getSlugs());
        $this->assertEquals('http://www.example.com:8000/?ref=testcase&foo=bar', $urlBuilder->build());
        $this->assertEquals('/?ref=testcase&foo=bar', $urlBuilder->build(false));

        $urlBuilder->setPath('');

        $this->assertEquals('/', $urlBuilder->getPath());
        $this->assertEquals([], $urlBuilder->getSlugs());
        $this->assertEquals('http://www.example.com:8000/?ref=testcase&foo=bar', $urlBuilder->build());
        $this->assertEquals('/?ref=testcase&foo=bar', $urlBuilder->build(false));
    }

    /** @test */
    public function it_sets_the_slugs()
    {
        $urlBuilder = new UrlBuilder('http://www.example.com:8000/abc/def?ref=testcase&foo=bar');

        $urlBuilder->setSlugs(['lorem', 'ipsum']);

        $this->assertEquals('/lorem/ipsum', $urlBuilder->getPath());
        $this->assertEquals(['lorem', 'ipsum'], $urlBuilder->getSlugs());
        $this->assertEquals('http://www.example.com:8000/lorem/ipsum?ref=testcase&foo=bar', $urlBuilder->build());
        $this->assertEquals('/lorem/ipsum?ref=testcase&foo=bar', $urlBuilder->build(false));

        $urlBuilder->setSlugs([]);

        $this->assertEquals('/', $urlBuilder->getPath());
        $this->assertEquals([], $urlBuilder->getSlugs());
        $this->assertEquals('http://www.example.com:8000/?ref=testcase&foo=bar', $urlBuilder->build());
        $this->assertEquals('/?ref=testcase&foo=bar', $urlBuilder->build(false));
    }

    /** @test */
    public function it_sets_the_query_string()
    {
        $urlBuilder = new UrlBuilder('http://www.example.com:8000/abc/def?ref=testcase&foo=bar');

        $urlBuilder->setQueryString('a=b&c=d');

        $this->assertEquals('a=b&c=d', $urlBuilder->getQueryString());
        $this->assertEquals(['a' => 'b', 'c' => 'd'], $urlBuilder->getQuery());
        $this->assertEquals('http://www.example.com:8000/abc/def?a=b&c=d', $urlBuilder->build());
        $this->assertEquals('/abc/def?a=b&c=d', $urlBuilder->build(false));

        $urlBuilder->setQueryString('');

        $this->assertEquals('', $urlBuilder->getQueryString());
        $this->assertEquals([], $urlBuilder->getQuery());
        $this->assertEquals('http://www.example.com:8000/abc/def', $urlBuilder->build());
        $this->assertEquals('/abc/def', $urlBuilder->build(false));
    }

    /** @test */
    public function it_sets_the_query_parameters()
    {
        $urlBuilder = new UrlBuilder('http://www.example.com:8000/abc/def?ref=testcase&foo=bar');

        $urlBuilder->setQuery(['a' => 'b', 'c' => 'd']);

        $this->assertEquals('a=b&c=d', $urlBuilder->getQueryString());
        $this->assertEquals(['a' => 'b', 'c' => 'd'], $urlBuilder->getQuery());
        $this->assertEquals('http://www.example.com:8000/abc/def?a=b&c=d', $urlBuilder->build());
        $this->assertEquals('/abc/def?a=b&c=d', $urlBuilder->build(false));

        $urlBuilder->setQuery([]);

        $this->assertEquals('', $urlBuilder->getQueryString());
        $this->assertEquals([], $urlBuilder->getQuery());
        $this->assertEquals('http://www.example.com:8000/abc/def', $urlBuilder->build());
        $this->assertEquals('/abc/def', $urlBuilder->build(false));
    }

    /** @test */
    public function it_adds_a_slash_between_the_host_and_query_string()
    {
        $urlBuilder = new UrlBuilder('http://www.example.com:8000/abc/def?ref=testcase&foo=bar');

        $urlBuilder->setQueryString('a=b&c=d');
        $urlBuilder->setPath('');

        $this->assertEquals('http://www.example.com:8000/?a=b&c=d', $urlBuilder->build());
        $this->assertEquals('/?a=b&c=d', $urlBuilder->build(false));
    }

    /** @test */
    public function it_removes_a_trailing_slash_after_the_host()
    {
        $urlBuilder = new UrlBuilder('http://www.example.com:8000/');

        $this->assertEquals('http://www.example.com:8000', $urlBuilder->build());
        $this->assertEquals('/', $urlBuilder->build(false));

        $urlBuilder = new UrlBuilder('http://www.example.com/');

        $this->assertEquals('http://www.example.com', $urlBuilder->build());
        $this->assertEquals('/', $urlBuilder->build(false));
    }
}
