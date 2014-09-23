<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace EtienneLamoureux\DurmandScriptorium;

use EtienneLamoureux\DurmandScriptorium\v2\CollectionApiConsumer;
use EtienneLamoureux\DurmandScriptorium\v2\CollectionApiRequestFactory;
use GuzzleHttp\Client;

class DurmandScriptorium
{

    const QUAGGANS_ENDPOINT = '/v2/quaggans';
    const LISTINGS_ENDPOINT = '/v2/commerce/listings';

    protected $quaggans;
    protected $listings;

    public function __construct()
    {
	$client = new Client();

	$quaggansRequestFactory = new CollectionApiRequestFactory(self::QUAGGANS_ENDPOINT);
	$this->quaggans = new CollectionApiConsumer($client, $quaggansRequestFactory);

	$listingsRequestFactory = new CollectionApiRequestFactory(self::LISTINGS_ENDPOINT);
	$this->listings = new CollectionApiConsumer($client, $listingsRequestFactory);
    }

    public function quaggans()
    {
	return $this->quaggans;
    }

    public function listings()
    {
	return $this->listings;
    }

}
