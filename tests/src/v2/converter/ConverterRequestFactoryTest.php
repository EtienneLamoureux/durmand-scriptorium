<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\v2\converter;

use Crystalgorithm\DurmandScriptorium\PHPUnitTest;

class ConverterRequestFactoryTest extends PHPUnitTest
{

    const VALID_AMOUNT_TO_CONVERT = 10000;
    const CONVERTER_ENDPOINT = 'endpoint';

    /**
     * @var ConverterRequestFactory
     */
    protected $factory;

    /**
     *
     * @var Client mock
     */
    protected $client;

    protected function setUp()
    {
	$this->client = $this->mock('\GuzzleHttp\Client');
	$this->factory = new ConverterRequestFactory;
    }

    protected function tearDown()
    {

    }

    public function testGivenValidAmountThenBuildConversionRequest()
    {
	// Remove the following lines when you implement this test.
	$this->markTestIncomplete(
		'This test has not been implemented yet.'
	);
    }

}
