<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium;

use Crystalgorithm\DurmandScriptorium\exceptions\BadRequestException;
use Crystalgorithm\DurmandScriptorium\utils\BatchRequestManager;
use Crystalgorithm\DurmandScriptorium\v2\RequestFactory;
use Crystalgorithm\PhpJsonIterator\JsonIteratorFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

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
     * @var BatchRequestManager
     */
    protected $batchRequestManager;

    /**
     * @var JsonIteratorFactory
     */
    protected $jsonIteratorFactory;

    /**
     * @var String
     */
    protected $idString;

    public function __construct(Client $client, RequestFactory $requestFactory, BatchRequestManager $batchRequestManager, JsonIteratorFactory $jsonIteratorFactory)
    {
	$this->client = $client;
	$this->requestFactory = $requestFactory;
	$this->batchRequestManager = $batchRequestManager;
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
	    return $this->getResponses($request);
	}

	try
	{
	    $response = $this->client->send($request);
	}
	catch (ClientException $ex)
	{
	    throw new BadRequestException($ex->getResponse()->json()['text']);
	}

	return $response;
    }

    protected function getResponses(array $requests)
    {
	return $this->batchRequestManager->executeRequests($requests);
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
