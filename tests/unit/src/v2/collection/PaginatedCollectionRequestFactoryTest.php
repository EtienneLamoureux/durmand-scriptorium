<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\v2\collection;

use Crystalgorithm\DurmandScriptorium\utils\Settings;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Query;
use InvalidArgumentException;
use Mockery;
use PHPUnit_Framework_TestCase;

class PaginatedCollectionRequestFactoryTest extends PHPUnit_Framework_TestCase
{

    const VALID_ID = 100;
    const NEGATIVE_ID = -1;
    const ZERO = 0;
    const NULL_ID = null;
    const VALID_PAGE = 0;
    const INVALID_PAGE = -1;
    const VALID_PAGE_SIZE = 50;
    const INVALID_PAGE_SIZE = 250;
    const COLLECTION_ENDPOINT = '/endpoint';

    /**
     * @var PaginatedCollectionRequestFactory
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
	$this->client = Mockery::mock('GuzzleHttp\Client');
	$this->request = Mockery::mock('GuzzleHttp\Message\Request');
	$this->query = Mockery::mock('GuzzleHttp\Query');

	$this->factory = new PaginatedCollectionRequestFactory($this->client, self::COLLECTION_ENDPOINT);
    }

    protected function tearDown()
    {
	Mockery::close();
    }

    public function testGivenValidIdWhenBuildingIdRequestThenBuildIdRequest()
    {
	$createRequestArgs = [Settings::GET, Settings::BASE_URL . self::COLLECTION_ENDPOINT, Settings::$CREATE_REQUEST_OPTIONS];
	$setArgs = [Settings::ID, self::VALID_ID];

	$this->client->shouldReceive('createRequest')->withArgs($createRequestArgs)->once()->andReturn($this->request);
	$this->request->shouldReceive('getQuery')->once()->andReturn($this->query);
	$this->query->shouldReceive('set')->withArgs($setArgs)->once();

	$this->factory->idRequest(self::VALID_ID);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGivenNullWhenBuildingIdRequestThenThrowException()
    {
	$this->factory->idRequest(self::NULL_ID);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGivenZeroWhenBuildingIdRequestThenThrowException()
    {
	$this->factory->idRequest(self::ZERO);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGivenNegativeIdWhenBuildingIdRequestThenThrowException()
    {
	$this->factory->idRequest(self::NEGATIVE_ID);
    }

    public function testGivenValidIdsWhenBuildingIdsRequestThenBuildIdsRequest()
    {
	$validIds = [self::VALID_ID, self::VALID_ID];
	$validIdsString = implode(Settings::ID_SEPARATOR, $validIds);
	$createRequestArgs = [Settings::GET, Settings::BASE_URL . self::COLLECTION_ENDPOINT, Settings::$CREATE_REQUEST_OPTIONS];
	$setArgs = [Settings::IDS, $validIdsString];

	$this->client->shouldReceive('createRequest')->withArgs($createRequestArgs)->once()->andReturn($this->request);
	$this->request->shouldReceive('getQuery')->once()->andReturn($this->query);
	$this->query->shouldReceive('set')->withArgs($setArgs)->once();

	$this->factory->idsRequest($validIds);
    }

    public function testGivenTooManyIdsWhenBuildingIdsRequestThenBuildManyIdsRequest()
    {
	$timesTooBig = 3;
	$validIds = array_fill(0, $timesTooBig * Settings::MAX_IDS_SINGLE_REQUEST, self::VALID_ID);
	$createRequestArgs = [Settings::GET, Settings::BASE_URL . self::COLLECTION_ENDPOINT, Settings::$CREATE_REQUEST_OPTIONS];

	$this->client->shouldReceive('createRequest')->withArgs($createRequestArgs)->times($timesTooBig)->andReturn($this->request);
	$this->request->shouldReceive('getQuery')->times($timesTooBig)->andReturn($this->query);
	$this->query->shouldReceive('set')->times($timesTooBig);

	$this->factory->idsRequest($validIds);
    }

    public function testGivenValidPageParamWhenBuildingPageRequestThenBuildPageRequest()
    {
	$createRequestArgs = [Settings::GET, Settings::BASE_URL . self::COLLECTION_ENDPOINT, Settings::$CREATE_REQUEST_OPTIONS];
	$setPageArgs = [Settings::PAGE, self::VALID_PAGE];
	$setPageSizeArgs = [Settings::PAGE_SIZE, self::VALID_PAGE_SIZE];

	$this->client->shouldReceive('createRequest')->withArgs($createRequestArgs)->once()->andReturn($this->request);
	$this->request->shouldReceive('getQuery')->once()->andReturn($this->query);
	$this->query->shouldReceive('set')->withArgs($setPageArgs)->once();
	$this->query->shouldReceive('set')->withArgs($setPageSizeArgs)->once();

	$this->factory->pageRequest(self::VALID_PAGE, self::VALID_PAGE_SIZE);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGivenNegativePageWhenBuildingPageRequestThenThrowException()
    {
	$this->factory->pageRequest(self::INVALID_PAGE);
    }

}
