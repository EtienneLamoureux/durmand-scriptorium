<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\v2\converter;

use Crystalgorithm\DurmandScriptorium\exceptions\BadRequestException;
use Crystalgorithm\DurmandScriptorium\utils\BatchRequestManager;
use Crystalgorithm\DurmandScriptorium\v2\RequestFactory;
use Crystalgorithm\PhpJsonIterator\JsonIteratorFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;
use Mockery;
use PHPUnit_Framework_TestCase;

class ConverterConsumerTest extends PHPUnit_Framework_TestCase
{

    const VALID_QUANTITY = 10000;
    const INSUFFICIENT_QUANTITY = 0;
    const EXCEPTION_MESSAGE = 'error';
    const TEXT = 'text';

    /**
     * @var ConverterConsumer
     */
    protected $consumer;

    /**
     * @var Client mock
     */
    protected $client;

    /**
     * @var RequestFactory mock
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
	$this->requestFactory = Mockery::mock('Crystalgorithm\DurmandScriptorium\v2\RequestFactory');
	$this->batchRequestManager = Mockery::mock('Crystalgorithm\DurmandScriptorium\utils\BatchRequestManager');
	$this->request = Mockery::mock('GuzzleHttp\Message\Request');
	$this->response = Mockery::mock('GuzzleHttp\Message\Response');
	$this->exception = Mockery::mock('GuzzleHttp\Exception\ClientException');
	$this->jsonIteratorFactory = Mockery::mock('Crystalgorithm\PhpJsonIterator\JsonIteratorFactory');

	$this->consumer = new ConverterConsumer($this->client, $this->requestFactory, $this->batchRequestManager, $this->jsonIteratorFactory);
    }

    protected function tearDown()
    {
	Mockery::close();
    }

    public function testGivenQuantityThenConvert()
    {
	$this->requestFactory->shouldReceive('conversionRequest')->with(self::VALID_QUANTITY)->once()->andReturn($this->request);
	$this->client->shouldReceive('send')->with($this->request)->once()->andReturn($this->response);
	$this->response->shouldReceive('json')->once();

	$this->consumer->convert(self::VALID_QUANTITY);
    }

    public function testGivenInvalidQuantityThenThrow()
    {
	$this->requestFactory->shouldReceive('conversionRequest')->with(self::INSUFFICIENT_QUANTITY)->once()->andReturn($this->request);
	$this->exception->shouldReceive('getResponse')->andReturn($this->response);
	$this->response->shouldReceive('json')->andReturn([self::TEXT => self::EXCEPTION_MESSAGE]);
	$this->client->shouldReceive('send')->with($this->request)->once()->andThrow($this->exception);

	try
	{
	    $this->consumer->convert(self::INSUFFICIENT_QUANTITY);
	}
	catch (BadRequestException $ex)
	{
	    $this->assertEquals(self::EXCEPTION_MESSAGE, $ex->getMessage());
	}
    }

}
