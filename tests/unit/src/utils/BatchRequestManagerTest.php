<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\utils;

use GuzzleHttp\Client;
use Mockery;
use PHPUnit_Framework_TestCase;

class BatchRequestManagerTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var BatchRequestManager
     */
    protected $batchRequestManager;

    /**
     * @var Client mock
     */
    protected $client;

    protected function setUp()
    {
	$this->client = Mockery::mock('\GuzzleHttp\Client');

	$this->batchRequestManager = new BatchRequestManager();
    }

    protected function tearDown()
    {
	Mockery::close();
    }

    public function testGivenRequestsThenExecute()
    {

    }

}
