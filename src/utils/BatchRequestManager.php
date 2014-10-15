<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\utils;

use GuzzleHttp\Client;
use GuzzleHttp\Event\CompleteEvent;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Pool;

class BatchRequestManager
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var array Array of file handles
     */
    protected $fileHandles;

    /**
     * @var int nb of maximum parallel requests
     */
    protected $parallel;

    public function __construct(Client $client, $parallel = Settings::NB_OF_PARALLEL_REQUESTS)
    {
	$this->client = $client;
	$this->parallel = $parallel;
	$this->fileHandles = array();
    }

    public function executeRequests(array $requests)
    {
	set_time_limit(Settings::TIMEOUT_LIMIT_IN_SECONDS);
	ini_set('memory_limit', Settings::MEMORY_LIMIT);
	$this->resetFileHandles();

	$pool = new Pool($this->client, $requests, [
	    'complete' => function (CompleteEvent $event)
	    {
		$this->saveResponseToFile($event->getResponse());
	    },
	    'pool_size' => Settings::NB_OF_PARALLEL_REQUESTS
	]);

	$pool->wait();

	return $this->fileHandles;
    }

    protected function saveResponseToFile(Response &$response)
    {
	$fileName = __DIR__ . '\\json\\' . sizeof($this->fileHandles) . '.json';
	$reponseSavedToFile = file_put_contents($fileName, $response->getBody());

	if ($reponseSavedToFile != false)
	{
	    $this->fileHandles[] = $fileName;
	}

	unset($response);
    }

    protected function resetFileHandles()
    {
	unset($this->fileHandles);
	$this->fileHandles = array();
    }

}
