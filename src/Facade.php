<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace Crystalgorithm\DurmandScriptorium;

use Crystalgorithm\DurmandScriptorium\utils\BatchRequestManager;
use Crystalgorithm\DurmandScriptorium\utils\Constants;
use Crystalgorithm\DurmandScriptorium\v2\CollectionConsumer;
use Crystalgorithm\DurmandScriptorium\v2\CollectionRequestFactory;
use GuzzleHttp\Client;

class Facade
{

    protected $quaggans;
    protected $listings;
    protected $prices;
    protected $items;

    public function __construct()
    {
	$client = new Client();

	$batchRequestManager = new BatchRequestManager($client);

	$quaggansRequestFactory = new CollectionRequestFactory($client, Constants::QUAGGANS_ENDPOINT);
	$this->quaggans = new CollectionConsumer($client, $quaggansRequestFactory, $batchRequestManager);

	$listingsRequestFactory = new CollectionRequestFactory($client, Constants::LISTINGS_ENDPOINT);
	$this->listings = new CollectionConsumer($client, $listingsRequestFactory, $batchRequestManager);

	$pricesRequestFactory = new CollectionRequestFactory($client, Constants::PRICES_ENDPOINT);
	$this->prices = new CollectionConsumer($client, $pricesRequestFactory, $batchRequestManager);

	$itemsRequestFactory = new CollectionRequestFactory($client, Constants::ITEMS_ENDPOINT);
	$this->items = new CollectionConsumer($client, $itemsRequestFactory, $batchRequestManager);
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
