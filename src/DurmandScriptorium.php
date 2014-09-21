<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace EtienneLamoureux\DurmandScriptorium;

use GuzzleHttp\Client;

class DurmandScriptorium
{

    protected $apiV2RequestFactory;
    protected $client;

    public function __construct()
    {
	$this->apiV2RequestFactory = new ApiV2RequestFactory();
	$this->client = new Client();
    }

    public function getQuaggans()
    {
	$request = $this->apiV2RequestFactory->quaggansRequest($this->client);
	$data = $this->getDataFromApi($request);

	return $data;
    }

    public function getQuaggan($id)
    {
	$request = $this->apiV2RequestFactory->quagganRequest($this->client, $id);
	$data = $this->getDataFromApi($request);

	return $data;
    }

    protected function getDataFromApi($request)
    {
	$jsonResponse = $this->client->send($request);
	$phpArray = $jsonResponse->json();

	return $phpArray;
    }

}
