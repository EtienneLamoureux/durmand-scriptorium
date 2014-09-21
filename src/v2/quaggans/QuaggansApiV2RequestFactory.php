<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace EtienneLamoureux\DurmandScriptorium\v2\quaggans;

class QuaggansApiV2RequestFactory extends \EtienneLamoureux\DurmandScriptorium\v2\ApiV2RequestFactory
{

    protected $ENDPOINT_URL = '/v2/quaggans';

    public function quagganRequest($client, $id)
    {
	$request = $this->buildBaseRequest($client);
	$query = $request->getQuery();
	$query->set('id', $id);

	return $request;
    }

    public function quaggansRequest($client, $ids)
    {
	$request = $this->buildBaseRequest($client);
	$query = $request->getQuery();
	$query->set('ids', $ids);

	return $request;
    }

}
