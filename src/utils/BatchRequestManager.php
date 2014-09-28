<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace Crystalgorithm\DurmandScriptorium\utils;

use GuzzleHttp\Client;
use GuzzleHttp\Event\CompleteEvent;
use GuzzleHttp\Event\ErrorEvent;

class BatchRequestManager
{

    protected $client;
    protected $aggregatedResponse;

    public function __construct(Client $client)
    {
	$this->client = $client;
	$this->aggregatedResponse = array();
    }

    public function executeRequests(array $requests)
    {
	set_time_limit(Constants::TIMEOUT_LIMIT_IN_SECONDS);
	ini_set('memory_limit', Constants::MEMORY_LIMIT_IN_BYTES);
	$this->resetAggregatedResponse();

	$requestChunks = array_chunk($requests, Constants::NB_OF_PARALLEL_REQUESTS);

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
		$this->aggregatedResponse[] = $event->getResponse();
	    },
	    'error' => function (ErrorEvent $event)
	    {
		// TODO log errors
//		echo 'Request failed: ' . $event->getRequest()->getUrl() . "\n";
//		echo $event->getException();
	    },
	    'parallel' => Constants::NB_OF_PARALLEL_REQUESTS
	]);
    }

    protected function resetAggregatedResponse()
    {
	unset($this->aggregatedResponse);
	$this->aggregatedResponse = array();
    }

}
