<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace EtienneLamoureux\DurmandScriptorium\v2;

abstract class ApiV2RequestFactory
{

    protected $BASE_URL = 'https://api.guildwars2.com';
    protected $ENDPOINT_URL = '';

    public function baseRequest($client)
    {
	$request = $this->buildBaseRequest($client);

	return $request;
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

    protected function buildBaseRequest($client)
    {
	return $client->createRequest('GET', $this->BASE_URL . $this->ENDPOINT_URL);
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
