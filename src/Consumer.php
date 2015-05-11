<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium;

use Crystalgorithm\DurmandScriptorium\utils\http\Client;
use Crystalgorithm\DurmandScriptorium\v2\RequestFactory;
use Crystalgorithm\PhpJsonIterator\JsonIteratorFactory;

abstract class Consumer
{

    /**
     * @var RequestFactory
     */
    protected $requestFactory;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var JsonIteratorFactory
     */
    protected $jsonIteratorFactory;

    /**
     * @var String
     */
    protected $idString;

    public function __construct(Client $client, RequestFactory $requestFactory, JsonIteratorFactory $jsonIteratorFactory)
    {
	$this->client = $client;
	$this->requestFactory = $requestFactory;
	$this->jsonIteratorFactory = $jsonIteratorFactory;
	$this->idString = null;
    }

    protected function getDataFromApi($request)
    {
	$response = $this->getResponse($request);
	$iterator = $this->convertResponseToArray($response);

	return $iterator;
    }

    protected function getResponse($request)
    {
	if (is_array($request))
	{
	    $response = $this->client->sendRequests($request);
	}
	else
	{
	    $response = $this->client->sendRequest($request);
	}

	return $response;
    }

    protected function convertResponseToArray($response)
    {
	if (is_array($response))
	{
	    return $this->convertResponsesToArray($response);
	}

	$iterator = $response->json();

	return $iterator;
    }

    protected function convertResponsesToArray(array $responses)
    {
	return $this->jsonIteratorFactory->buildJsonFilesIterator($responses, ['firstTopLevelString' => $this->idString]);
    }

}
