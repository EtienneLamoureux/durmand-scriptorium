<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\v2\converter;

use Crystalgorithm\DurmandScriptorium\utils\BatchRequestManager;
use Crystalgorithm\DurmandScriptorium\v2\RequestFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;
use Mockery;
use PHPUnit_Framework_TestCase;

class ConverterConsumerTest extends PHPUnit_Framework_TestCase
{

    const VALID_QUANTITY = 10000;

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

    protected function setUp()
    {
	$this->client = Mockery::mock('GuzzleHttp\Client');
	$this->requestFactory = Mockery::mock('Crystalgorithm\DurmandScriptorium\v2\RequestFactory');
	$this->batchRequestManager = Mockery::mock('Crystalgorithm\DurmandScriptorium\utils\BatchRequestManager');
	$this->request = Mockery::mock('GuzzleHttp\Message\Request');
	$this->response = Mockery::mock('GuzzleHttp\Message\Response');

	$this->consumer = new ConverterConsumer($this->client, $this->requestFactory, $this->batchRequestManager);
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

}
