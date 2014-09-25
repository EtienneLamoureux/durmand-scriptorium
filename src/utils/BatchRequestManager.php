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
    protected $jsonResponse;

    public function __construct(Client $client)
    {
	$this->client = $client;
	$this->jsonResponse = '';
    }

    public function executeRequests(array $requests)
    {

	$this->jsonResponse = '';
	$requestChunks = array_chunk($requests, self::NB_OF_PARALLEL_REQUESTS);

	foreach ($requestChunks as $requestChunk)
	{
	    $this->sendRequestChunk($requestChunk);
	}

	return $this->jsonResponse;
    }

    protected function sendRequestChunk(array $requests)
    {
	$this->client->sendAll($requests, [
	    // Call this function when each request completes
	    'complete' => function (CompleteEvent $event)
	    {
		echo 'Completed request to ' . $event->getRequest()->getUrl() . "<br />";
		$this->jsonResponse = $this->jsonResponse . $event->getResponse()->getBody();
	    },
	    // Call this function when a request encounters an error
	    'error' => function (ErrorEvent $event)
	    {
		echo 'Request failed: ' . $event->getRequest()->getUrl() . "\n";
		echo $event->getException();
	    },
	    // Maintain a maximum pool size of 25 concurrent requests.
	    'parallel' => self::NB_OF_PARALLEL_REQUESTS
	]);
    }

}
