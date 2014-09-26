<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace EtienneLamoureux\DurmandScriptorium;

use EtienneLamoureux\DurmandScriptorium\utils\BatchRequestManager;
use EtienneLamoureux\DurmandScriptorium\utils\Constants;
use EtienneLamoureux\DurmandScriptorium\v2\CollectionApiConsumer;
use EtienneLamoureux\DurmandScriptorium\v2\CollectionApiRequestFactory;
use GuzzleHttp\Client;

class DurmandScriptorium
{

    protected $quaggans;
    protected $listings;
    protected $prices;
    protected $items;

    public function __construct()
    {
	$client = new Client();

	$batchRequestManager = new BatchRequestManager($client);

	$quaggansRequestFactory = new CollectionApiRequestFactory($client, Constants::QUAGGANS_ENDPOINT);
	$this->quaggans = new CollectionApiConsumer($client, $quaggansRequestFactory, $batchRequestManager);

	$listingsRequestFactory = new CollectionApiRequestFactory($client, Constants::LISTINGS_ENDPOINT);
	$this->listings = new CollectionApiConsumer($client, $listingsRequestFactory, $batchRequestManager);

	$pricesRequestFactory = new CollectionApiRequestFactory($client, Constants::PRICES_ENDPOINT);
	$this->prices = new CollectionApiConsumer($client, $pricesRequestFactory, $batchRequestManager);

	$itemsRequestFactory = new CollectionApiRequestFactory($client, Constants::ITEMS_ENDPOINT);
	$this->items = new CollectionApiConsumer($client, $itemsRequestFactory, $batchRequestManager);
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

    public function items()
    {
	return $this->items;
    }

}
