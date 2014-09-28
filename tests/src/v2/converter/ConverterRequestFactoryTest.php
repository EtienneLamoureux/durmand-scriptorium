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
use InvalidArgumentException;
use Mockery;
use PHPUnit_Framework_TestCase;

class ConverterRequestFactoryTest extends PHPUnit_Framework_TestCase
{

    const VALID_AMOUNT = 10000;
    const NEGATIVE_AMOUNT = -1;
    const ZERO = 0;
    const NULL_AMOUNT = null;
    const SCHEME_TO_HOST = '://';
    const CONVERTER_ENDPOINT = '/endpoint';

    /**
     * @var ConverterRequestFactory
     */
    protected $factory;

    /**
     * @var Client
     */
    protected $client;

    protected function setUp(
    )
    {

	$this->client = new Client();
	$this->factory = new ConverterRequestFactory($this->client, self::CONVERTER_ENDPOINT);
    }

    protected function tearDown()
    {
	Mockery::close();
    }

    public function testGivenAmountThenBuildConversionRequest()
    {
	$request = $this->factory->conversionRequest(self::VALID_AMOUNT);
	$query = $request->getQuery();
	$requestedUrl = $request->getScheme() . self::SCHEME_TO_HOST . $request->getHost() . $request->getPath();

	$this->assertEquals(Constants::BASE_URL . self::CONVERTER_ENDPOINT, $requestedUrl);
	$this->assertEquals(self::VALID_AMOUNT, $query[ConverterRequestFactory::QUANTITY]);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGivenNullThenThrowsException()
    {
	$this->factory->conversionRequest(self::NULL_AMOUNT);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGivenZeroThenThrowsException()
    {
	$this->factory->conversionRequest(self::ZERO);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGivenNegativeAmountThenThrowsException()
    {
	$this->factory->conversionRequest(self::NEGATIVE_AMOUNT);
    }

}
