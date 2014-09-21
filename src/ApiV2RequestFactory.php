<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace EtienneLamoureux\DurmandScriptorium;

class ApiV2RequestFactory
{

    const BASE_URL = 'https://api.guildwars2.com';
    const QUAGGANS_URL = '/v2/quaggans';

    public static function quaggansRequest($client)
    {
	$request = $client->createRequest('GET', constant('self::BASE_URL') . constant('self::QUAGGANS_URL'));

	return $request;
    }

    public static function quagganRequest($client, $id)
    {
	$request = $client->createRequest('GET', constant('self::BASE_URL') . constant('self::QUAGGANS_URL'));
	$query = $request->getQuery();
	$query->set('id', $id);

	return $request;
    }

}
