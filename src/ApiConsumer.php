<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace EtienneLamoureux\DurmandScriptorium;

use GuzzleHttp\Event\CompleteEvent;
use GuzzleHttp\Event\ErrorEvent;

abstract class ApiConsumer
{

    protected $requestFactory;
    protected $client;

    public function __construct($client, $requestFactory)
    {
	$this->client = $client;
	$this->requestFactory = $requestFactory;
    }

    protected function getDataFromApi($request)
    {
	$jsonResponse = $this->client->send($request);
	$phpArray = $this->convertJsonToArray($jsonResponse);

	return $phpArray;
    }

    protected function executeBatch($requests)
    {
	$this->client->sendAll($requests, [
	    // Call this function when each request completes
	    'complete' => function (CompleteEvent $event)
	    {
		echo 'Completed request to ' . $event->getRequest()->getUrl() . "\n";
		echo 'Response: ' . $event->getResponse()->getBody() . "\n\n";
	    },
	    // Call this function when a request encounters an error
	    'error' => function (ErrorEvent $event)
	    {
		echo 'Request failed: ' . $event->getRequest()->getUrl() . "\n";
		echo $event->getException();
	    },
	    // Maintain a maximum pool size of 25 concurrent requests.
	    'parallel' => 100
	]);
    }

    protected function convertJsonToArray($jsonResponse)
    {
	return $jsonResponse->json();
    }

}
