<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace EtienneLamoureux\DurmandScriptorium;

use GuzzleHttp\Client;

abstract class ApiConsumer
{

    protected $requestFactory;
    protected $client;

    public function __construct()
    {
	$this->client = new Client();
    }

    protected function getDataFromApi($request)
    {
	$jsonResponse = $this->client->send($request);
	$phpArray = $jsonResponse->json();

	return $phpArray;
    }

}
