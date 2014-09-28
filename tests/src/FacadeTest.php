<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium;

use Crystalgorithm\DurmandScriptorium\Facade;
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

    /**
     * @ignore
     */
    public function testCanReachQuaggans()
    {
	$data = $this->api->quaggans()->getAll();

	$this->assertNotNull($data);
    }

    /**
     * @ignore
     */
    public function testCanReachListings()
    {
	$data = $this->api->listings()->getAll();

	$this->assertNotNull($data);
    }

    /**
     * @ignore
     */
    public function testCanReachPrices()
    {
	$data = $this->api->prices()->getAll();

	$this->assertNotNull($data);
    }

    /**
     * @ignore
     */
    public function testCanReachItems()
    {
	$data = $this->api->items()->getAll();

	$this->assertNotNull($data);
    }

    /**
     * @ignore
     */
    public function testCanReachCoins()
    {
	$data = $this->api->coins()->convert(self::VALID_AMOUNT_TO_CONVERT);

	$this->assertNotNull($data);
    }

    /**
     * @ignore
     */
    public function testCanReachGems()
    {
	$data = $this->api->gems()->convert(self::VALID_AMOUNT_TO_CONVERT);

	$this->assertNotNull($data);
    }

}
