<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\v2\converter;

use Crystalgorithm\DurmandScriptorium\utils\Constants;
use Crystalgorithm\DurmandScriptorium\v2\collection\CollectionRequestFactory;
use Crystalgorithm\DurmandScriptorium\v2\converter\ConverterRequestFactory;
use GuzzleHttp\Client;
use PHPUnit_Framework_TestCase;

class CollectionRequestFactoryFunctionalTest extends PHPUnit_Framework_TestCase
{

    const VALID_ID = 100;
    const VALID_PAGE = 0;
    const VALID_PAGE_SIZE = 50;
    const SCHEME_TO_HOST = '://';
    const COLLECTION_ENDPOINT = '/endpoint';

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
	$this->factory = new CollectionRequestFactory($this->client, self::COLLECTION_ENDPOINT);
    }

    public function testGivenIdThenBuildIdRequest()
    {
	$request = $this->factory->idRequest(self::VALID_ID);
	$query = $request->getQuery();
	$requestedUrl = $request->getScheme() . self::SCHEME_TO_HOST . $request->getHost() . $request->getPath();

	$this->assertEquals(Constants::BASE_URL . self::COLLECTION_ENDPOINT, $requestedUrl);
	$this->assertEquals(self::VALID_ID, $query[CollectionRequestFactory::ID]);
    }

    public function testGivenIdsThenBuildIdsRequest()
    {
	$validIds = [self::VALID_ID, self::VALID_ID];
	$validIdsString = implode(CollectionRequestFactory::ID_SEPARATOR, $validIds);

	$request = $this->factory->idsRequest($validIds);
	$query = $request->getQuery();
	$requestedUrl = $request->getScheme() . self::SCHEME_TO_HOST . $request->getHost() . $request->getPath();

	$this->assertEquals(Constants::BASE_URL . self::COLLECTION_ENDPOINT, $requestedUrl);
	$this->assertEquals($validIdsString, $query[CollectionRequestFactory::IDS]);
    }

    public function testGivenPageParamsThenBuildPageRequest()
    {
	$request = $this->factory->pageRequest(self::VALID_PAGE, self::VALID_PAGE_SIZE);
	$query = $request->getQuery();
	$requestedUrl = $request->getScheme() . self::SCHEME_TO_HOST . $request->getHost() . $request->getPath();

	$this->assertEquals(Constants::BASE_URL . self::COLLECTION_ENDPOINT, $requestedUrl);
	$this->assertEquals(self::VALID_PAGE, $query[CollectionRequestFactory::PAGE]);
	$this->assertEquals(self::VALID_PAGE_SIZE, $query[CollectionRequestFactory::PAGE_SIZE]);
    }

}