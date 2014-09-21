<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace EtienneLamoureux\DurmandScriptorium;

use GuzzleHttp\Client;

class DurmandScriptorium
{

    public function __DurmandScriptorium()
    {

    }

    public function getQuaggans()
    {
	$client = new Client();
	$request = ApiV2RequestFactory::quaggansRequest($client);
	$response = $client->send($request);
	$json = $response->json();

	return $json;
    }

}
