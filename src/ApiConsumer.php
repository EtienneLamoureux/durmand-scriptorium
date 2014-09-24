<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace EtienneLamoureux\DurmandScriptorium;

use EtienneLamoureux\DurmandScriptorium\utils\BatchRequestManager;
use GuzzleHttp\Event\CompleteEvent;
use GuzzleHttp\Event\ErrorEvent;

abstract class ApiConsumer
{

    protected $requestFactory;
    protected $client;
    protected $batchRequestManager;

    public function __construct($client, $requestFactory)
    {
	$this->client = $client;
	$this->requestFactory = $requestFactory;
	$this->batchRequestManager = new BatchRequestManager();
    }

    protected function getDataFromApi($request)
    {
	if (is_array($request))
	{
	    $this->batchRequestManager->executeRequests($request);
	}
	else
	{
	    $jsonResponse = $this->client->send($request);
	    $phpArray = $this->convertJsonToArray($jsonResponse);
	}

	return $phpArray;
    }

    protected function convertJsonToArray($jsonResponse)
    {
	return $jsonResponse->json();
    }

}
