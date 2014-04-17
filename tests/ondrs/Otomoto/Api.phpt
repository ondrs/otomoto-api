<?php

use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';


class ApiTest extends \Tester\TestCase
{

    /** @var \ondrs\Otomoto\Api */
    private $api;


    function setUp()
    {
        // put your own
        $username = '***';
        $key = '***';
        $iv = '***';
        $ip = '***';

        $this->api = new \ondrs\Otomoto\Api($username, $key, $iv, $ip);
        $this->api->createClient(8526);
    }


    function testGenerateTestKey()
    {
        $key = $this->api->generateKey('test;01/16/2014 09:06:16;123.123.123.1');
        Assert::equal('TJCT0+vJMU4Pp7sjMGYQlOgefHJZpvEh3w3f4d+4ZAfDmxfeXOHhP8j9Jp5bht0J', $key);
    }


    function testGenerateKey()
    {
        Assert::type('string', $this->api->generateKey());
    }


    function testAdvertQuickList()
    {
        Assert::type('array', $this->api->advertQuickList());
    }


    function testEnumList()
    {
        Assert::type('array', $this->api->enumList());
    }


    function testEnumValueList()
    {
        Assert::type('array', $this->api->enumValueList(20));
    }



}

id(new ApiTest)->run();
