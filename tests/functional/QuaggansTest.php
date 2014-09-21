<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
use GuzzleHttp\Client;
use EtienneLamoureux\DurmandScriptorium\ApiV2RequestFactory;

class QuaggansTest extends PHPUnit_Framework_TestCase
{

    protected $client;

    protected function setUp()
    {
	$this->client = new Client();
    }

    public function testClientCanReachApi()
    {
	$request = ApiV2RequestFactory::quaggansRequest($this->client);
	$response = $this->client->send($request);

	$this->assertEquals(200, $response->getStatusCode());
    }

}
