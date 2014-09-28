<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\v2\converter;

use Crystalgorithm\DurmandScriptorium\utils\Constants;
use GuzzleHttp\Client;
use InvalidArgumentException;
use PHPUnit_Framework_TestCase;

class ConverterRequestFactoryTest extends PHPUnit_Framework_TestCase
{

    const VALID_QUANTITY = 10000;
    const NEGATIVE_QUANTITY = -1;
    const ZERO = 0;
    const NULL_QUANTITY = null;
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

    protected function setUp()
    {

	$this->client = new Client();
	$this->factory = new ConverterRequestFactory($this->client, self::CONVERTER_ENDPOINT);
    }

    public function testGivenAmountThenBuildConversionRequest()
    {
	$request = $this->factory->conversionRequest(self::VALID_QUANTITY);
	$query = $request->getQuery();
	$requestedUrl = $request->getScheme() . self::SCHEME_TO_HOST . $request->getHost() . $request->getPath();

	$this->assertEquals(Constants::BASE_URL . self::CONVERTER_ENDPOINT, $requestedUrl);
	$this->assertEquals(self::VALID_QUANTITY, $query[ConverterRequestFactory::QUANTITY]);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGivenNullThenThrowsException()
    {
	$this->factory->conversionRequest(self::NULL_QUANTITY);
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
	$this->factory->conversionRequest(self::NEGATIVE_QUANTITY);
    }

}
