<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace EtienneLamoureux\DurmandScriptorium\utils;

use GuzzleHttp\Client;
use GuzzleHttp\Event\CompleteEvent;
use GuzzleHttp\Event\ErrorEvent;

class BatchRequestManager
{

    const NB_OF_PARALLEL_REQUESTS = 25;

    protected $client;
    protected $aggregatedResponse;

    public function __construct(Client $client)
    {
	$this->client = $client;
	$this->aggregatedResponse = array();
    }

    public function executeRequests(array $requests)
    {
	unset($this->aggregatedResponse);
	$this->aggregatedResponse = array();
	$requestChunks = array_chunk($requests, self::NB_OF_PARALLEL_REQUESTS);

	foreach ($requestChunks as $requestChunk)
	{
	    $this->sendRequestChunk($requestChunk);
	}

	return $this->aggregatedResponse;
    }

    protected function sendRequestChunk(array $requests)
    {
	$this->client->sendAll($requests, [
	    'complete' => function (CompleteEvent $event)
	    {
		echo 'Completed request to ' . $event->getRequest()->getUrl() . "<br />";
		$response = $event->getResponse()->json();
		$this->aggregatedResponse = array_merge($this->aggregatedResponse, $response);
	    },
	    'error' => function (ErrorEvent $event)
	    {
		echo 'Request failed: ' . $event->getRequest()->getUrl() . "\n";
		echo $event->getException();
	    },
	    'parallel' => self::NB_OF_PARALLEL_REQUESTS
	]);
    }

}
