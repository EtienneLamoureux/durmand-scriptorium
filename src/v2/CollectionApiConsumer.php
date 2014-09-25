<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace EtienneLamoureux\DurmandScriptorium\v2;

use EtienneLamoureux\DurmandScriptorium\ApiConsumer;

class CollectionApiConsumer extends ApiConsumer
{

    public function getAll($expanded = false)
    {
	if ($expanded)
	{
	    $ids = $this->getAll();
	    $data = $this->getMany($ids);
	}
	else
	{
	    $request = $this->requestFactory->baseRequest();
	    $data = $this->getDataFromApi($request);
	}

	return $data;
    }

    public function get($id)
    {
	$request = $this->requestFactory->idRequest($id);
	$data = $this->getDataFromApi($request);

	return $data;
    }

    public function getMany(array $ids)
    {
	$request = $this->requestFactory->idsRequest($ids);
	$data = $this->getDataFromApi($request);

	return $data;
    }

}
