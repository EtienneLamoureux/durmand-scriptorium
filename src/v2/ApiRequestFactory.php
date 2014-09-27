<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace Crystalgorithm\DurmandScriptorium\v2;

use Crystalgorithm\DurmandScriptorium\utils\Constants;
use GuzzleHttp\Client;

abstract class ApiRequestFactory
{

    protected $ENDPOINT_URL = '';
    protected $client;

    public function __construct(Client $client, $endpointUrl)
    {
	$this->client = $client;
	$this->ENDPOINT_URL = $endpointUrl;
    }

    public function baseRequest()
    {
	$request = $this->buildBaseRequest($this->client);

	return $request;
    }

    protected function buildBaseRequest()
    {
	return $this->client->createRequest('GET', Constants::BASE_URL . $this->ENDPOINT_URL);
    }

}
