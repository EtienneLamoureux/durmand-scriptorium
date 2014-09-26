<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace EtienneLamoureux\DurmandScriptorium;

use EtienneLamoureux\DurmandScriptorium\utils\BatchRequestManager;
use EtienneLamoureux\DurmandScriptorium\v2\ApiRequestFactory;
use GuzzleHttp\Client;

abstract class ApiConsumer
{

    protected $requestFactory;
    protected $client;
    protected $batchRequestManager;

    public function __construct(Client $client, ApiRequestFactory $requestFactory, BatchRequestManager $batchRequestManager)
    {
	$this->client = $client;
	$this->requestFactory = $requestFactory;
	$this->batchRequestManager = $batchRequestManager;
    }

    protected function getDataFromApi($request)
    {
	if (is_array($request))
	{
	    $phpArray = $this->batchRequestManager->executeRequests($request);
	}
	else
	{
	    $response = $this->client->send($request);
	    $phpArray = $response->json();
	}

	return $phpArray;
    }

}
