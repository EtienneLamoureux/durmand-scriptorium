<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\v2\collection;

use Crystalgorithm\DurmandScriptorium\exceptions\BadRequestException;
use Crystalgorithm\DurmandScriptorium\utils\BatchRequestManager;
use Crystalgorithm\DurmandScriptorium\utils\Settings;
use Crystalgorithm\DurmandScriptorium\v2\collection\PaginatedCollectionConsumer;
use Crystalgorithm\DurmandScriptorium\v2\collection\PaginatedCollectionRequestFactory;
use Crystalgorithm\PhpJsonIterator\JsonIteratorFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;
use Mockery;
use PHPUnit_Framework_TestCase;

class PaginatedCollectionConsumerTest extends PHPUnit_Framework_TestCase
{

    const VALID_ID = 100;
    const INVALID_ID = -1;
    const NB_PAGE = 2;
    const ONE_PAGE = 0;
    const FIRST_PAGE = 0;
    const LAST_PAGE = 1;
    const VALID_PAGE = 1;
    const INVALID_PAGE = 1;
    const INVALID_PAGE_SIZE = 250;
    const TEXT = 'text';
    const EXCEPTION_MESSAGE = 'error';

    /**
     * @vaV2CollectionConsumerer
     */
    protected $consumer;

    /**
     * @var Client mock
     */
    protected $client;

    /**
     * @var PaginatedCollectionRequestFactory mock
     */
    protected $requestFactory;

    /**
     * @var BatchRequestManager mock
     */
    protected $batchRequestManager;

    /**
     * @var Request mock
     */
    protected $request;

    /**
     * @var Response mock
     */
    protected $response;

    /**
     * @var ClientException mock
     */
    protected $exception;

    /**
     *
     * @var JsonIteratorFactory
     */
    protected $jsonIteratorFactory;

    protected function setUp()
    {
	$this->client = Mockery::mock('GuzzleHttp\Client');
	$this->requestFactory = Mockery::mock('Crystalgorithm\DurmandScriptorium\v2\collection\PaginatedCollectionRequestFactory');
	$this->batchRequestManager = Mockery::mock('Crystalgorithm\DurmandScriptorium\utils\BatchRequestManager');
	$this->request = Mockery::mock('GuzzleHttp\Message\Request');
	$this->response = Mockery::mock('GuzzleHttp\Message\Response');
	$this->exception = Mockery::mock('GuzzleHttp\Exception\ClientException');
	$this->jsonIteratorFactory = Mockery::mock('Crystalgorithm\PhpJsonIterator\JsonIteratorFactory');

	$this->consumer = new PaginatedCollectionConsumer($this->client, $this->requestFactory, $this->batchRequestManager, $this->jsonIteratorFactory);
    }

    protected function tearDown()
    {
	Mockery::close();
    }

    public function testGivenIdThenGet()
    {
	$this->requestFactory->shouldReceive('idRequest')->with(self::VALID_ID)->once()->andReturn($this->request);
	$this->client->shouldReceive('send')->with($this->request)->once()->andReturn($this->response);
	$this->response->shouldReceive('json')->once();

	$this->consumer->get(self::VALID_ID);
    }

    public function testGivenIdsThenGet()
    {
	$ids = [self::VALID_ID, self::VALID_ID];
	$this->requestFactory->shouldReceive('idsRequest')->with($ids)->once()->andReturn($this->request);
	$this->client->shouldReceive('send')->with($this->request)->once()->andReturn($this->response);
	$this->response->shouldReceive('json')->once();

	$this->consumer->get($ids);
    }

    public function testGivenEmptyIdsThenNeverCall()
    {
	$emptyArray = [];
	$this->requestFactory->shouldReceive('idsRequest')->never();
	$this->client->shouldReceive('send')->never();

	$data = $this->consumer->get($emptyArray);

	$this->assertEquals($emptyArray, $data);
    }

    public function testWhenRequestAllIdsThenGetAllIds()
    {
	$this->requestFactory->shouldReceive('baseRequest')->once()->andReturn($this->request);
	$this->client->shouldReceive('send')->with($this->request)->once()->andReturn($this->response);
	$this->response->shouldReceive('json')->once();

	$this->consumer->getAll();
    }

    public function testWhenRequestPageRangeGet()
    {
	$this->requestFactory->shouldReceive('pageRequest')->andReturn($this->request);
	$this->client->shouldReceive('send')->with($this->request)->andReturn($this->response);
	$this->response->shouldReceive('getHeader')->with(Settings::TOTAL_PAGE_HEADER)->once()->andReturn(self::NB_PAGE);

	$actual = $this->consumer->getPageRange();

	$expected = ['first' => self::FIRST_PAGE, 'last' => self::LAST_PAGE];
	$this->assertEquals($expected, $actual);
    }

    public function testWhenRequestAllDetailsThenGetAllDetails()
    {
	$responses = [$this->response, $this->response];

	$this->requestFactory->shouldReceive('pageRequest')->atLeast(1)->andReturn($this->request);
	$this->client->shouldReceive('send')->with($this->request)->atLeast(1)->andReturn($this->response);
	$this->response->shouldReceive('getHeader')->with(Settings::TOTAL_PAGE_HEADER)->once()->andReturn(self::NB_PAGE);
	$this->response->shouldReceive('json')->atLeast(1)->andReturn([]);
	$this->batchRequestManager->shouldReceive('executeRequests')->once()->andReturn($responses);
	$this->jsonIteratorFactory->shouldReceive('buildJsonFilesIterator');

	$this->consumer->getAll(true);
    }

    public function testGivenPageThenGet()
    {
	$this->requestFactory->shouldReceive('pageRequest')->once()->andReturn($this->request);
	$this->client->shouldReceive('send')->with($this->request)->once()->andReturn($this->response);
	$this->response->shouldReceive('json')->once();

	$this->consumer->getPage(self::VALID_PAGE);
    }

    public function testGivenInvalidIdThenThrow()
    {
	$this->requestFactory->shouldReceive('idRequest')->with(self::INVALID_ID)->once()->andReturn($this->request);
	$this->exception->shouldReceive('getResponse')->andReturn($this->response);
	$this->response->shouldReceive('json')->andReturn([self::TEXT => self::EXCEPTION_MESSAGE]);
	$this->client->shouldReceive('send')->with($this->request)->once()->andThrow($this->exception);

	try
	{
	    $this->consumer->get(self::INVALID_ID);
	}
	catch (BadRequestException $ex)
	{
	    $this->assertEquals(self::EXCEPTION_MESSAGE, $ex->getMessage());
	}
    }

    public function testGivenInvalidPageThenThrow()
    {
	$this->requestFactory->shouldReceive('pageRequest')->with(self::INVALID_PAGE, null)->once()->andReturn($this->request);
	$this->exception->shouldReceive('getResponse')->andReturn($this->response);
	$this->response->shouldReceive('json')->andReturn([self::TEXT => self::EXCEPTION_MESSAGE]);
	$this->client->shouldReceive('send')->with($this->request)->once()->andThrow($this->exception);

	try
	{
	    $this->consumer->getPage(self::INVALID_PAGE);
	}
	catch (BadRequestException $ex)
	{
	    $this->assertEquals(self::EXCEPTION_MESSAGE, $ex->getMessage());
	}
    }

    public function testGivenInvalidPageSizeThenThrow()
    {
	$this->requestFactory->shouldReceive('pageRequest')->with(self::VALID_PAGE, self::INVALID_PAGE_SIZE)->once()->andReturn($this->request);
	$this->exception->shouldReceive('getResponse')->andReturn($this->response);
	$this->response->shouldReceive('json')->andReturn([self::TEXT => self::EXCEPTION_MESSAGE]);
	$this->client->shouldReceive('send')->with($this->request)->once()->andThrow($this->exception);

	try
	{
	    $this->consumer->getPage(self::VALID_PAGE, self::INVALID_PAGE_SIZE);
	}
	catch (BadRequestException $ex)
	{
	    $this->assertEquals(self::EXCEPTION_MESSAGE, $ex->getMessage());
	}
    }

}
