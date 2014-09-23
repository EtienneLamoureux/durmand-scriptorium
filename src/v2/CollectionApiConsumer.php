<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace EtienneLamoureux\DurmandScriptorium\v2;

use GuzzleHttp\Exception\ClientException;
use Guzzle\Batch\Batch;
use Guzzle\Batch\BatchRequestTransfer;

class CollectionApiConsumer extends \EtienneLamoureux\DurmandScriptorium\ApiConsumer
{

    const ALL = 'all';

    public function getAll($expanded = false)
    {
	if ($expanded)
	{
	    $data = $this->getAllExpanded();
	}
	else
	{
	    $request = $this->requestFactory->baseRequest($this->client);
	    $data = $this->getDataFromApi($request);
	}

	return $data;
    }

    public function get($id)
    {
	$request = $this->requestFactory->idRequest($this->client, $id);
	$data = $this->getDataFromApi($request);

	return $data;
    }

    public function getMany($ids)
    {
	$request = $this->requestFactory->idsRequest($this->client, $ids);
	$data = $this->getDataFromApi($request);

	return $data;
    }

    protected function getAllExpanded()
    {
	try
	{
	    $data = $this->getMany(self::ALL);
	}
	catch (ClientException $exc)
	{
	    $ids = $this->getAll();
	    $requests = $this->requestFactory->idsBatchRequest($this->client, $ids);
	    $this->executeBatch($requests);
	}

	return $data;
    }

}
