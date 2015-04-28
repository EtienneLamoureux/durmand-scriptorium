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
use Crystalgorithm\DurmandScriptorium\v2\collection\paginated\PaginatedCollectionConsumer;
use Crystalgorithm\DurmandScriptorium\v2\collection\searchable\SearchableCollectionConsumer;
use Crystalgorithm\DurmandScriptorium\v2\ConsumerFactory;
use Crystalgorithm\DurmandScriptorium\v2\converter\ConverterConsumer;
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
     * @var SearchableCollectionConsumer
     */
    protected $recipes;

    public function __construct($localeCode = Locale::ENGLISH)
    {
	$this->setLocale($localeCode);

	$client = new Client();
	$batchRequestManager = new BatchRequestManager($client);
	$jsonIteratorFactory = new JsonIteratorFactory();
	$consumerFactory = new ConsumerFactory($client, $batchRequestManager, $jsonIteratorFactory);

	$this->quaggans = $consumerFactory->buildQuaggansConsumer();
	$this->listings = $consumerFactory->buildListingsConsumer();
	$this->prices = $consumerFactory->buildPricesConsumer();
	$this->items = $consumerFactory->buildItemsConsumer();
	$this->coins = $consumerFactory->buildCoinsConsumer();
	$this->gems = $consumerFactory->buildGemsConsumer();
	$this->worlds = $consumerFactory->buildWorldsConsumer();
	$this->recipes = $consumerFactory->buildRecipesConsumer();
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
