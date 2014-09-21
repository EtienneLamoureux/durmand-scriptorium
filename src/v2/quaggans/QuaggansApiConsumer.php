<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace EtienneLamoureux\DurmandScriptorium\v2\quaggans;

class QuaggansApiConsumer extends \EtienneLamoureux\DurmandScriptorium\ApiConsumer
{

    public function __construct()
    {
	parent::__construct();
	$this->requestFactory = new QuaggansApiV2RequestFactory();
    }

    public function getAllQuaggans()
    {
	$request = $this->requestFactory->baseRequest($this->client);
	$data = $this->getDataFromApi($request);

	return $data;
    }

    public function getAllExpandedQuaggans()
    {
	$request = $this->requestFactory->quaggansRequest($this->client, 'all');
	$data = $this->getDataFromApi($request);

	return $data;
    }

    public function getQuaggan($id)
    {
	$request = $this->requestFactory->quagganRequest($this->client, $id);
	$data = $this->getDataFromApi($request);

	return $data;
    }

    public function getQuaggans($ids)
    {
	$request = $this->requestFactory->quaggansRequest($this->client, $ids);
	$data = $this->getDataFromApi($request);

	return $data;
    }

}
