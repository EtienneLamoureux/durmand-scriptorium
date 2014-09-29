<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\v2\collection;

use Crystalgorithm\DurmandScriptorium\utils\Constants;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Query;
use InvalidArgumentException;
use Mockery;
use PHPUnit_Framework_TestCase;

class CollectionRequestFactoryTest extends PHPUnit_Framework_TestCase
{

    const VALID_ID = 100;
    const NEGATIVE_ID = -1;
    const ZERO = 0;
    const NULL_ID = null;
    const COLLECTION_ENDPOINT = '/endpoint';

    protected static $VALID_IDS = [100, 101];

    /**
     * @var CollectionRequestFactory
     */
    protected $factory;

    /**
     * @var Client mock
     */
    protected $client;

    /**
     * @var Request mock
     */
    protected $request;

    /**
     * @var Query mock
     */
    protected $query;

    protected function setUp()
    {
	$this->client = Mockery::mock('\GuzzleHttp\Client');
	$this->request = Mockery::mock('\GuzzleHttp\Message\Request');
	$this->query = Mockery::mock('\GuzzleHttp\Query');

	$this->factory = new CollectionRequestFactory($this->client, self::COLLECTION_ENDPOINT);
    }

    protected function tearDown()
    {
	Mockery::close();
    }

    public function testGivenValidIdWhenBuildingIdRequestThenBuildIdRequest()
    {
	$createRequestArgs = [CollectionRequestFactory::GET, Constants::BASE_URL . self::COLLECTION_ENDPOINT];
	$setArgs = [CollectionRequestFactory::ID, self::VALID_ID];

	$this->client->shouldReceive('createRequest')->matchArgs($createRequestArgs)->once()->andReturn($this->request);
	$this->request->shouldReceive('getQuery')->once()->andReturn($this->query);
	$this->query->shouldReceive('set')->matchArgs($setArgs)->once();

	$this->factory->idRequest(self::VALID_ID);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGivenNullWhenBuildingIdRequestThenThrowsException()
    {
	$this->factory->idRequest(self::NULL_ID);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGivenZeroWhenBuildingIdRequestThenThrowsException()
    {
	$this->factory->idRequest(self::ZERO);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGivenNegativeIdWhenBuildingIdRequestThenThrowsException()
    {
	$this->factory->idRequest(self::NEGATIVE_ID);
    }

    public function testGivenValidIdsWhenBuildingIdsRequestThenBuildIdsRequest()
    {
	$createRequestArgs = [CollectionRequestFactory::GET, Constants::BASE_URL . self::COLLECTION_ENDPOINT];
	$setArgs = [CollectionRequestFactory::ID, self::VALID_ID];

	$this->client->shouldReceive('createRequest')->matchArgs($createRequestArgs)->once()->andReturn($this->request);
	$this->request->shouldReceive('getQuery')->once()->andReturn($this->query);
	$this->query->shouldReceive('set')->matchArgs($setArgs)->once();

	$this->factory->idRequest(self::VALID_ID);
    }

}
