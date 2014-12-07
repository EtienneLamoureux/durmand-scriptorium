<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium;

use Crystalgorithm\DurmandScriptorium\utils\BatchRequestManager;
use Crystalgorithm\DurmandScriptorium\utils\Settings;
use Crystalgorithm\DurmandScriptorium\v2\collection\PaginatedCollectionRequestFactory;
use GuzzleHttp\Client;
use PHPUnit_Framework_TestCase;

class FacadeTest extends PHPUnit_Framework_TestCase
{

    const VALID_AMOUNT_TO_CONVERT = 10000;

    /**
     * @var Facade
     */
    protected $api;

    protected function setUp()
    {
	$this->api = new Facade;
    }

    protected function tearDown()
    {
	parent::tearDown();
    }

    public function testCanReachQuaggans()
    {
	$data = $this->api->quaggans()->getAll();

	$this->assertNotNull($data);
    }

    public function testCanReachWorlds()
    {
	$data = $this->api->worlds()->getAll();

	$this->assertNotNull($data);
    }

    public function testCanReachListings()
    {
	$data = $this->api->listings()->getAll();

	$this->assertNotNull($data);
    }

    public function testCanReachPrices()
    {
	$data = $this->api->prices()->getAll();

	$this->assertNotNull($data);
    }

    public function testCanReachItems()
    {
	$data = $this->api->items()->getAll();

	$this->assertNotNull($data);
    }

    public function testCanReachCoins()
    {
	$data = $this->api->coins()->convert(self::VALID_AMOUNT_TO_CONVERT);

	$this->assertNotNull($data);
    }

    public function testCanReachGems()
    {
	$data = $this->api->gems()->convert(self::VALID_AMOUNT_TO_CONVERT);

	$this->assertNotNull($data);
    }

    public function testCanReachRecipes()
    {
	$data = $this->api->recipes()->getAll();

	$this->assertNotNull($data);
    }

    /**
     * TODO make functional
     */
    public function testCanSendBatchRequests()
    {
	$client = new Client();
	$batchRequestManager = new BatchRequestManager($client);

	$requestFactory = new PaginatedCollectionRequestFactory($client, Settings::QUAGGANS_ENDPOINT);
	$request = $requestFactory->baseRequest();
	$responses = $batchRequestManager->executeRequests([$request]);

	$this->assertNotNull($responses);
    }

}
