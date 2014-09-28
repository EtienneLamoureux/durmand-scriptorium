<?php

namespace Crystalgorithm\DurmandScriptorium\v2\converter;

class ConverterRequestFactoryTest extends \PHPUnit_Framework_TestCase
{

    const VALID_AMOUNT_TO_CONVERT = 10000;
    const CONVERTER_ENDPOINT = 'endpoint';

    /**
     * @var ConverterRequestFactory
     */
    protected $factory;

    protected function setUp()
    {
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
