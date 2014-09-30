<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\utils;

use GuzzleHttp\Client;
use GuzzleHttp\Event\CompleteEvent;
use GuzzleHttp\Event\ErrorEvent;

class BatchRequestManager
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var array Array of Response
     */
    protected $aggregatedResponse;

    /**
     * @var int nb of maximum parallel requests
     */
    protected $parallel;

    public function __construct(Client $client, $parallel = Constants::NB_OF_PARALLEL_REQUESTS)
    {
	$this->client = $client;
	$this->parallel = $parallel;
	$this->aggregatedResponse = array();
    }

    public function executeRequests(array $requests)
    {
	set_time_limit(Constants::TIMEOUT_LIMIT_IN_SECONDS);
	ini_set('memory_limit', Constants::MEMORY_LIMIT_IN_BYTES);
	$this->resetAggregatedResponse();

	$requestChunks = array_chunk($requests, $this->parallel);

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
	    'parallel' => $this->parallel
	]);
    }

    protected function resetAggregatedResponse()
    {
	unset($this->aggregatedResponse);
	$this->aggregatedResponse = array();
    }

}
