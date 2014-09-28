<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\v2\converter;

use Crystalgorithm\DurmandScriptorium\utils\Constants;
use Crystalgorithm\DurmandScriptorium\v2\converter\ConverterRequestFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Query;
use Mockery;
use PHPUnit_Framework_TestCase;

class ConverterRequestFactoryTest extends PHPUnit_Framework_TestCase
{

    const VALID_AMOUNT = 10000;
    const INVALID_AMOUNT = 0;
    const INSUFFICIENT_AMOUNT = 1;
    const CONVERTER_ENDPOINT = 'endpoint';

    /**
     * @var ConverterRequestFactory
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
	$this->factory = new ConverterRequestFactory($this->client, self::CONVERTER_ENDPOINT);
    }

    protected function tearDown()
    {
	Mockery::close();
    }

    public function testGivenValidAmountThenBuildConversionRequest()
    {
	$createRequestArgs = ['GET', Constants::BASE_URL . self::CONVERTER_ENDPOINT];
	$setArgs = ['quantity', self::VALID_AMOUNT];

	$this->client->shouldReceive('createRequest')->matchArgs($createRequestArgs)->once()->andReturn($this->request);
	$this->request->shouldReceive('getQuery')->once()->andReturn($this->query);
	$this->query->shouldReceive('set')->matchArgs($setArgs)->once();

	$returnedRequest = $this->factory->conversionRequest(self::VALID_AMOUNT);
	$this->assertSame($this->request, $returnedRequest);
    }

}
