<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium;

use Crystalgorithm\DurmandScriptorium\utils\BatchRequestManager;
use Crystalgorithm\DurmandScriptorium\utils\Settings;
use Crystalgorithm\DurmandScriptorium\v2\collection\PaginatedCollectionConsumer;
use Crystalgorithm\DurmandScriptorium\v2\collection\PaginatedCollectionRequestFactory;
use Crystalgorithm\DurmandScriptorium\v2\converter\ConverterConsumer;
use Crystalgorithm\DurmandScriptorium\v2\converter\ConverterRequestFactory;
use GuzzleHttp\Client;

class Facade
{

    /**
     * @var PaginatedCollectionConsumer
     */
    protected $quaggans;

    /**
     * @var PaginatedCollectionConsumer
     */
    protected $listings;

    /**
     * @var PaginatedCollectionConsumer
     */
    protected $prices;

    /**
     * @var PaginatedCollectionConsumer
     */
    protected $items;

    /**
     * @var ConverterConsumer
     */
    protected $coins;

    /**
     * @var ConverterConsumer
     */
    protected $gems;

    public function __construct()
    {
	$client = new Client();

	$batchRequestManager = new BatchRequestManager($client);

	$quaggansRequestFactory = new PaginatedCollectionRequestFactory($client, Settings::QUAGGANS_ENDPOINT);
	$this->quaggans = new PaginatedCollectionConsumer($client, $quaggansRequestFactory, $batchRequestManager);

	$listingsRequestFactory = new PaginatedCollectionRequestFactory($client, Settings::LISTINGS_ENDPOINT);
	$this->listings = new PaginatedCollectionConsumer($client, $listingsRequestFactory, $batchRequestManager);

	$pricesRequestFactory = new PaginatedCollectionRequestFactory($client, Settings::PRICES_ENDPOINT);
	$this->prices = new PaginatedCollectionConsumer($client, $pricesRequestFactory, $batchRequestManager);

	$itemsRequestFactory = new PaginatedCollectionRequestFactory($client, Settings::ITEMS_ENDPOINT);
	$this->items = new PaginatedCollectionConsumer($client, $itemsRequestFactory, $batchRequestManager);

	$coinsRequestFactory = new ConverterRequestFactory($client, Settings::COINS_ENDPOINT);
	$this->coins = new ConverterConsumer($client, $coinsRequestFactory, $batchRequestManager);

	$gemsRequestFactory = new ConverterRequestFactory($client, Settings::GEMS_ENDPOINT);
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
