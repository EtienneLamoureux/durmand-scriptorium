<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium;

use Crystalgorithm\DurmandScriptorium\utils\BatchRequestManager;
use Crystalgorithm\DurmandScriptorium\utils\Locale;
use Crystalgorithm\DurmandScriptorium\utils\Settings;
use Crystalgorithm\DurmandScriptorium\v2\collection\PaginatedCollectionConsumer;
use Crystalgorithm\DurmandScriptorium\v2\collection\PaginatedCollectionRequestFactory;
use Crystalgorithm\DurmandScriptorium\v2\converter\ConverterConsumer;
use Crystalgorithm\DurmandScriptorium\v2\converter\ConverterRequestFactory;
use Crystalgorithm\DurmandScriptorium\v2\search\RecipesSearchConsumer;
use Crystalgorithm\DurmandScriptorium\v2\search\SearchRequestFactory;
use Crystalgorithm\PhpJsonIterator\JsonIteratorFactory;
use GuzzleHttp\Client;
use UnexpectedValueException;

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

    /**
     * @var PaginatedCollectionConsumer
     */
    protected $worlds;

    /**
     * @var PaginatedCollectionConsumer
     */
    protected $recipes;

    /**
     * @var RecipesSearchConsumer
     */
    protected $recipesSearch;

    public function __construct($localeCode = Locale::ENGLISH)
    {
	$this->setLocale($localeCode);

	$client = new Client();

	$batchRequestManager = new BatchRequestManager($client);
	$jsonIteratorFactory = new JsonIteratorFactory();

	$quaggansRequestFactory = new PaginatedCollectionRequestFactory($client, Settings::QUAGGANS_ENDPOINT);
	$this->quaggans = new PaginatedCollectionConsumer($client, $quaggansRequestFactory, $batchRequestManager, $jsonIteratorFactory, 'id');

	$listingsRequestFactory = new PaginatedCollectionRequestFactory($client, Settings::LISTINGS_ENDPOINT);
	$this->listings = new PaginatedCollectionConsumer($client, $listingsRequestFactory, $batchRequestManager, $jsonIteratorFactory, 'id');

	$pricesRequestFactory = new PaginatedCollectionRequestFactory($client, Settings::PRICES_ENDPOINT);
	$this->prices = new PaginatedCollectionConsumer($client, $pricesRequestFactory, $batchRequestManager, $jsonIteratorFactory, 'id');

	$itemsRequestFactory = new PaginatedCollectionRequestFactory($client, Settings::ITEMS_ENDPOINT, true);
	$this->items = new PaginatedCollectionConsumer($client, $itemsRequestFactory, $batchRequestManager, $jsonIteratorFactory, 'name');

	$coinsRequestFactory = new ConverterRequestFactory($client, Settings::COINS_ENDPOINT);
	$this->coins = new ConverterConsumer($client, $coinsRequestFactory, $batchRequestManager, $jsonIteratorFactory);

	$gemsRequestFactory = new ConverterRequestFactory($client, Settings::GEMS_ENDPOINT);
	$this->gems = new ConverterConsumer($client, $gemsRequestFactory, $batchRequestManager, $jsonIteratorFactory);

	$worldsRequestFactory = new PaginatedCollectionRequestFactory($client, Settings::WORLDS_ENDPOINT, true);
	$this->worlds = new PaginatedCollectionConsumer($client, $worldsRequestFactory, $batchRequestManager, $jsonIteratorFactory, 'id');

	$receipesRequestFactory = new PaginatedCollectionRequestFactory($client, Settings::RECIPES_ENDPOINT, true);
	$this->recipes = new PaginatedCollectionConsumer($client, $receipesRequestFactory, $batchRequestManager, $jsonIteratorFactory, 'type');

	$recipesSearchRequestFactory = new SearchRequestFactory($client, Settings::RECIPES_SEARCH_ENDPOINT, true);
	$this->recipesSearch = new RecipesSearchConsumer($client, $recipesSearchRequestFactory, $batchRequestManager, $jsonIteratorFactory);
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

    /**
     *
     * @return PaginatedCollectionConsumer
     */
    public function worlds()
    {
	return $this->worlds;
    }

    /**
     *
     * @return PaginatedCollectionConsumer
     */
    public function recipes()
    {
	return $this->recipes;
    }

    /**
     *
     * @return RecipesSearchConsumer
     */
    public function recipesSearch()
    {
	return $this->recipesSearch;
    }

    /**
     * @param string $localeCode ISO 639-1 locale code
     * @see Locale
     * @throws UnexpectedValueException if given an unsupported locale code
     */
    public function setLocale($localeCode)
    {
	$locale = new Locale($localeCode);
	Settings::$LOCALE = $locale->getValue();
    }

}
