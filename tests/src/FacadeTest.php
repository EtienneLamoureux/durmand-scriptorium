<?php

namespace Crystalgorithm\DurmandScriptorium;

class FacadeTest extends PHPUnitTest
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

    }

    public function testCanReachQuaggans()
    {
	$data = $this->api->quaggans()->getAll();

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

}
