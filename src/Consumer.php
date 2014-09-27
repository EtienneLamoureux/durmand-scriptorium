<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace Crystalgorithm\DurmandScriptorium;

use Crystalgorithm\DurmandScriptorium\utils\BatchRequestManager;
use Crystalgorithm\DurmandScriptorium\v2\RequestFactory;
use GuzzleHttp\Client;

abstract class Consumer
{

    protected $requestFactory;
    protected $client;
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
	    $response = $this->client->send($request);
	}

	return $response;
    }

    protected function convertResponseToArray($response)
    {
	if (is_array($response))
	{
	    if (sizeof($response) <= 0)
	    {
		return array();
	    }

	    $phpArray = array();

	    foreach ($response as $value)
	    {
		$phpArray = array_merge($phpArray, $value->json());
	    }
	}
	else
	{
	    $phpArray = $response->json();
	}

	return $phpArray;
    }

}
