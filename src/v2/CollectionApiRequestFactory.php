<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace EtienneLamoureux\DurmandScriptorium\v2;

class CollectionApiRequestFactory extends ApiRequestFactory
{

    public function __construct($endpointUrl)
    {
	$this->ENDPOINT_URL = $endpointUrl;
    }

    public function idRequest($client, $id)
    {
	$request = $this->buildBaseRequest($client);
	$query = $request->getQuery();
	$query->set('id', $id);

	return $request;
    }

    public function idsRequest($client, $ids)
    {
	$request = $this->buildBaseRequest($client);
	$query = $request->getQuery();

	$formattedIds = $this->formatIds($ids);
	$query->set('ids', $formattedIds);

	return $request;
    }

    public function idsBatchRequest($client, $ids)
    {
	$requests = array();

	foreach ($ids as $id)
	{
	    $requests[] = $this->idRequest($client, $id);
	}

	return $requests;
    }

    protected function formatIds($ids)
    {
	if (is_array($ids))
	{
	    return implode(',', $ids);
	}

	return $ids;
    }

}
