<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\v2\converter;

use Crystalgorithm\DurmandScriptorium\utils\Settings;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Query;
use InvalidArgumentException;
use Mockery;
use PHPUnit_Framework_TestCase;

class ConverterRequestFactoryTest extends PHPUnit_Framework_TestCase
{

    const VALID_QUANTITY = 10000;
    const NEGATIVE_QUANTITY = -1;
    const ZERO = 0;
    const NULL_QUANTITY = null;
    const CONVERTER_ENDPOINT = '/endpoint';

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
	$this->client = Mockery::mock('GuzzleHttp\Client');
	$this->request = Mockery::mock('GuzzleHttp\Message\Request');
	$this->query = Mockery::mock('GuzzleHttp\Query');

	$this->factory = new ConverterRequestFactory($this->client, self::CONVERTER_ENDPOINT);
    }

    protected function tearDown()
    {
	Mockery::close();
    }

    public function testGivenValidAmountThenBuildConversionRequest()
    {
	$createRequestArgs = [Settings::GET, Settings::BASE_URL . self::CONVERTER_ENDPOINT, Settings::$CREATE_REQUEST_OPTIONS];
	$setArgs = [Settings::QUANTITY, self::VALID_QUANTITY];

	$this->client->shouldReceive('createRequest')->withArgs($createRequestArgs)->once()->andReturn($this->request);
	$this->request->shouldReceive('getQuery')->once()->andReturn($this->query);
	$this->query->shouldReceive('set')->withArgs($setArgs)->once();

	$this->factory->conversionRequest(self::VALID_QUANTITY);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGivenNullThenThrowException()
    {
	$this->factory->conversionRequest(self::NULL_QUANTITY);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGivenZeroThenThrowException()
    {
	$this->factory->conversionRequest(self::ZERO);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGivenNegativeAmountThenThrowException()
    {
	$this->factory->conversionRequest(self::NEGATIVE_QUANTITY);
    }

}
