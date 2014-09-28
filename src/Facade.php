<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium;

use Crystalgorithm\DurmandScriptorium\utils\BatchRequestManager;
use Crystalgorithm\DurmandScriptorium\utils\Constants;
use Crystalgorithm\DurmandScriptorium\v2\collection\CollectionConsumer;
use Crystalgorithm\DurmandScriptorium\v2\collection\CollectionRequestFactory;
use Crystalgorithm\DurmandScriptorium\v2\converter\ConverterConsumer;
use Crystalgorithm\DurmandScriptorium\v2\converter\ConverterRequestFactory;
use GuzzleHttp\Client;

class Facade
{

    protected $quaggans;
    protected $listings;
    protected $prices;
    protected $items;
    protected $coins;
    protected $gems;

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

	$coinsRequestFactory = new ConverterRequestFactory($client, Constants::COINS_ENDPOINT);
	$this->coins = new ConverterConsumer($client, $coinsRequestFactory, $batchRequestManager);

	$gemsRequestFactory = new ConverterRequestFactory($client, Constants::GEMS_ENDPOINT);
	$this->gems = new ConverterConsumer($client, $gemsRequestFactory, $batchRequestManager);
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

    public function coins()
    {
	return $this->coins;
    }

    public function gems()
    {
	return $this->gems;
    }

}
