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
use Crystalgorithm\PhpJsonIterator\JsonIteratorFactory;
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
	$jsonIteratorFactory = new JsonIteratorFactory();

	$quaggansRequestFactory = new PaginatedCollectionRequestFactory($client, Settings::QUAGGANS_ENDPOINT);
	$this->quaggans = new PaginatedCollectionConsumer($client, $quaggansRequestFactory, $batchRequestManager, $jsonIteratorFactory, 'id');

	$listingsRequestFactory = new PaginatedCollectionRequestFactory($client, Settings::LISTINGS_ENDPOINT);
	$this->listings = new PaginatedCollectionConsumer($client, $listingsRequestFactory, $batchRequestManager, $jsonIteratorFactory, 'id');

	$pricesRequestFactory = new PaginatedCollectionRequestFactory($client, Settings::PRICES_ENDPOINT);
	$this->prices = new PaginatedCollectionConsumer($client, $pricesRequestFactory, $batchRequestManager, $jsonIteratorFactory, 'id');

	$itemsRequestFactory = new PaginatedCollectionRequestFactory($client, Settings::ITEMS_ENDPOINT);
	$this->items = new PaginatedCollectionConsumer($client, $itemsRequestFactory, $batchRequestManager, $jsonIteratorFactory, 'name');

	$coinsRequestFactory = new ConverterRequestFactory($client, Settings::COINS_ENDPOINT);
	$this->coins = new ConverterConsumer($client, $coinsRequestFactory, $batchRequestManager, $jsonIteratorFactory);

	$gemsRequestFactory = new ConverterRequestFactory($client, Settings::GEMS_ENDPOINT);
	$this->gems = new ConverterConsumer($client, $gemsRequestFactory, $batchRequestManager, $jsonIteratorFactory);
    }

    /**
     * @return PaginatedCollectionConsumer
     */
    public function quaggans()
    {
	return $this->quaggans;
    }

    /**
     * @return PaginatedCollectionConsumer
     */
    public function listings()
    {
	return $this->listings;
    }

    /**
     * @return PaginatedCollectionConsumer
     */
    public function prices()
    {
	return $this->prices;
    }

    /**
     * @return PaginatedCollectionConsumer
     */
    public function items()
    {
	return $this->items;
    }

    /**
     * @return ConverterConsumer
     */
    public function coins()
    {
	return $this->coins;
    }

    /**
     * @return ConverterConsumer
     */
    public function gems()
    {
	return $this->gems;
    }

}
