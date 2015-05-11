<?php

namespace Crystalgorithm\DurmandScriptorium\http\guzzle;

use Crystalgorithm\DurmandScriptorium\http\exceptions\BadRequestException;
use Crystalgorithm\DurmandScriptorium\http\HttpClient;
use Crystalgorithm\DurmandScriptorium\utils\Settings;
use GuzzleHttp\Client;
use GuzzleHttp\Event\CompleteEvent;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Pool;

class GuzzleClientAdaptor implements HttpClient
{

    /**
     * @var Client
     */
    protected $guzzleClient;

    /**
     * @var array Array of file handles where JSON responses are stored
     */
    protected $fileHandles;

    public function __construct(Client $guzzleClient)
    {
	$this->guzzleClient = $guzzleClient;
	$this->fileHandles = array();
    }

    public function buildGetRequest($method, $url, array $options = [])
    {
	$guzzleRequest = $this->guzzleClient->createRequest($method, $url, $options);
	$request = GuzzleRequestAdaptor($guzzleRequest);

	return $request;
    }

    public function sendRequest(Request $request)
    {
	try
	{
	    $guzzleResponse = $this->guzzleClient->send($request);
	    return $guzzleResponse;
	}
	catch (ClientException $exception)
	{
	    throw new BadRequestException($exception->getResponse()->json()['text']);
	}
    }

    public function sendRequests(array $requests)
    {
	set_time_limit(Settings::TIMEOUT_LIMIT_IN_SECONDS);
	ini_set('memory_limit', Settings::MEMORY_LIMIT);
	$this->resetFileHandles();

	$pool = new Pool($this->guzzleClient, $requests, [
	    'complete' => function (CompleteEvent $event)
	    {
		$this->saveResponseToFile($event->getResponse());
	    },
	    'pool_size' => Settings::NB_OF_PARALLEL_REQUESTS
	]);

	$pool->wait();

	return $this->fileHandles;
    }

    private function saveResponseToFile(Response &$response)
    {
	$fileName = __DIR__ . '\\json\\' . sizeof($this->fileHandles) . '.json';
	$reponseSavedToFile = file_put_contents($fileName, $response->getBody());

	if ($reponseSavedToFile != false)
	{
	    $this->fileHandles[] = $fileName;
	}

	unset($response);
    }

    private function resetFileHandles()
    {
	unset($this->fileHandles);
	$this->fileHandles = array();
    }

}
