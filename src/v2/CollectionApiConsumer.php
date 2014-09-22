<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace EtienneLamoureux\DurmandScriptorium\v2;

class CollectionApiConsumer extends \EtienneLamoureux\DurmandScriptorium\ApiConsumer
{

    public function __construct($requestFactory)
    {
	parent::__construct($requestFactory);
    }

    public function getAll()
    {
	$request = $this->requestFactory->baseRequest($this->client);
	$data = $this->getDataFromApi($request);

	return $data;
    }

    public function getAllExpanded()
    {
	$request = $this->requestFactory->idsRequest($this->client, 'all');
	$data = $this->getDataFromApi($request);

	return $data;
    }

    public function get($id)
    {
	$request = $this->requestFactory->idRequest($this->client, $id);
	$data = $this->getDataFromApi($request);

	return $data;
    }

    public function getSome($ids)
    {
	$request = $this->requestFactory->idsRequest($this->client, $ids);
	$data = $this->getDataFromApi($request);

	return $data;
    }

}
