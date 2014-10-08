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

    public function __construct(Client $client, RequestFactory $requestFactory, BatchRequestManager $batchRequestManager)
    {
	$this->client = $client;
	$this->requestFactory = $requestFactory;
	$this->batchRequestManager = $batchRequestManager;
    }

    protected function getDataFromApi($request)
    {
	$response = $this->getResponse($request);
	$phpArray = $this->convertResponseToArray($response);

	return $phpArray;
    }

    protected function getResponse($request)
    {
	if (is_array($request))
	{
	    if (sizeof($request) <= 0)
	    {
		return array();
	    }

	    $response = $this->batchRequestManager->executeRequests($request);
	}
	else
	{
	    try
	    {
		$response = $this->client->send($request);
	    }
	    catch (ClientException $ex)
	    {
		throw new BadRequestException($ex->getResponse()->json()['text']);
	    }
	}

	return $response;
    }

    protected function convertResponseToArray($response)
    {
	if (is_array($response))
	{
	    $phpArray = $this->convertResponsesToArray($response);
	}
	else
	{
	    $phpArray = $response->json();
	}

	return $phpArray;
    }

    protected function convertResponsesToArray(array &$responses)
    {
	$phpArray = array();

	foreach ($responses as $response)
	{
	    $phpArray = array_merge($phpArray, $response->json());
	}

	return $phpArray;
    }

}
