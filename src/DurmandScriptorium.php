<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace EtienneLamoureux\DurmandScriptorium;

use EtienneLamoureux\DurmandScriptorium\utils\BatchRequestManager;
use EtienneLamoureux\DurmandScriptorium\v2\CollectionApiConsumer;
use EtienneLamoureux\DurmandScriptorium\v2\CollectionApiRequestFactory;
use GuzzleHttp\Client;

class DurmandScriptorium
{

    const QUAGGANS_ENDPOINT = '/v2/quaggans';
    const LISTINGS_ENDPOINT = '/v2/commerce/listings';
    const PRICES_ENDPOINT = '/v2/commerce/prices';

    protected $quaggans;
    protected $listings;
    protected $prices;

    public function __construct()
    {
	$client = new Client();

	$batchRequestManager = new BatchRequestManager($client);

	$quaggansRequestFactory = new CollectionApiRequestFactory($client, self::QUAGGANS_ENDPOINT);
	$this->quaggans = new CollectionApiConsumer($client, $quaggansRequestFactory, $batchRequestManager);

	$listingsRequestFactory = new CollectionApiRequestFactory($client, self::LISTINGS_ENDPOINT);
	$this->listings = new CollectionApiConsumer($client, $listingsRequestFactory, $batchRequestManager);

	$pricesRequestFactory = new CollectionApiRequestFactory($client, self::PRICES_ENDPOINT);
	$this->prices = new CollectionApiConsumer($client, $pricesRequestFactory, $batchRequestManager);
    }

    public function quaggans()
    {
	return $this->quaggans;
    }

    public function listings()
    {
	return $this->listings;
    }

    public function prices()
    {
	return $this->prices;
    }

}
