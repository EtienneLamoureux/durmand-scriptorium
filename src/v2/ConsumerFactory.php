<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\v2;

use Crystalgorithm\DurmandScriptorium\utils\Settings;
use Crystalgorithm\DurmandScriptorium\v2\collection\paginated\PaginatedCollectionConsumer;
use Crystalgorithm\DurmandScriptorium\v2\collection\paginated\PaginatedCollectionRequestFactory;
use Crystalgorithm\DurmandScriptorium\v2\collection\searchable\SearchableCollectionConsumer;
use Crystalgorithm\DurmandScriptorium\v2\collection\searchable\SearchableCollectionRequestFactory;
use Crystalgorithm\DurmandScriptorium\v2\converter\ConverterConsumer;
use Crystalgorithm\DurmandScriptorium\v2\converter\ConverterRequestFactory;

class ConsumerFactory
{

    private $client;
    private $jsonIteratorFactory;

    public function __construct($client, $jsonIteratorFactory)
    {
	$this->client = $client;
	$this->jsonIteratorFactory = $jsonIteratorFactory;
    }

    public function buildQuaggansConsumer()
    {
	$quaggansRequestFactory = new PaginatedCollectionRequestFactory($this->client, Settings::QUAGGANS_ENDPOINT);
	$quaggans = new PaginatedCollectionConsumer($this->client, $quaggansRequestFactory, $this->jsonIteratorFactory, 'id');

	return $quaggans;
    }

    public function buildListingsConsumer()
    {
	$listingsRequestFactory = new PaginatedCollectionRequestFactory($this->client, Settings::LISTINGS_ENDPOINT);
	$listings = new PaginatedCollectionConsumer($this->client, $listingsRequestFactory, $this->jsonIteratorFactory, 'id');

	return $listings;
    }

    public function buildPricesConsumer()
    {
	$pricesRequestFactory = new PaginatedCollectionRequestFactory($this->client, Settings::PRICES_ENDPOINT);
	$prices = new PaginatedCollectionConsumer($this->client, $pricesRequestFactory, $this->jsonIteratorFactory, 'id');

	return $prices;
    }

    public function buildItemsConsumer()
    {
	$itemsRequestFactory = new PaginatedCollectionRequestFactory($this->client, Settings::ITEMS_ENDPOINT, true);
	$items = new PaginatedCollectionConsumer($this->client, $itemsRequestFactory, $this->jsonIteratorFactory, 'name');

	return $items;
    }

    public function buildCoinsConsumer()
    {
	$coinsRequestFactory = new ConverterRequestFactory($this->client, Settings::COINS_ENDPOINT);
	$coins = new ConverterConsumer($this->client, $coinsRequestFactory, $this->jsonIteratorFactory);

	return $coins;
    }

    public function buildGemsConsumer()
    {
	$gemsRequestFactory = new ConverterRequestFactory($this->client, Settings::GEMS_ENDPOINT);
	$gems = new ConverterConsumer($this->client, $gemsRequestFactory, $this->jsonIteratorFactory);

	return $gems;
    }

    public function buildWorldsConsumer()
    {
	$worldsRequestFactory = new PaginatedCollectionRequestFactory($this->client, Settings::WORLDS_ENDPOINT, true);
	$worlds = new PaginatedCollectionConsumer($this->client, $worldsRequestFactory, $this->jsonIteratorFactory, 'id');


	return $worlds;
    }

    public function buildRecipesConsumer()
    {
	$receipesRequestFactory = new SearchableCollectionRequestFactory($this->client, Settings::RECIPES_ENDPOINT, true);
	$recipes = new SearchableCollectionConsumer($this->client, $receipesRequestFactory, $this->jsonIteratorFactory, 'type');

	return $recipes;
    }

}
