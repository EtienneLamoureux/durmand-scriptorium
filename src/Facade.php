<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium;

use Crystalgorithm\DurmandScriptorium\utils\BatchRequestManager;
use Crystalgorithm\DurmandScriptorium\utils\Settings;
use Crystalgorithm\DurmandScriptorium\v2\collection\V2CollectionConsumer;
use Crystalgorithm\DurmandScriptorium\v2\collection\CollectionRequestFactory;
use Crystalgorithm\DurmandScriptorium\v2\converter\ConverterConsumer;
use Crystalgorithm\DurmandScriptorium\v2\converter\ConverterRequestFactory;
use GuzzleHttp\Client;

class Facade
{

    /**
     * @var V2CollectionConsumer
     */
    protected $quaggans;

    /**
     * @var V2CollectionConsumer
     */
    protected $listings;

    /**
     * @var V2CollectionConsumer
     */
    protected $prices;

    /**
     * @var V2CollectionConsumer
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

	$quaggansRequestFactory = new CollectionRequestFactory($client, Settings::QUAGGANS_ENDPOINT);
	$this->quaggans = new V2CollectionConsumer($client, $quaggansRequestFactory, $batchRequestManager);

	$listingsRequestFactory = new CollectionRequestFactory($client, Settings::LISTINGS_ENDPOINT);
	$this->listings = new V2CollectionConsumer($client, $listingsRequestFactory, $batchRequestManager);

	$pricesRequestFactory = new CollectionRequestFactory($client, Settings::PRICES_ENDPOINT);
	$this->prices = new V2CollectionConsumer($client, $pricesRequestFactory, $batchRequestManager);

	$itemsRequestFactory = new CollectionRequestFactory($client, Settings::ITEMS_ENDPOINT);
	$this->items = new V2CollectionConsumer($client, $itemsRequestFactory, $batchRequestManager);

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
