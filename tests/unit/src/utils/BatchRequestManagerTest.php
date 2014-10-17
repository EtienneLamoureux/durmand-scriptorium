<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\utils;

use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;
use Mockery;
use PHPUnit_Framework_TestCase;

class BatchRequestManagerTest extends PHPUnit_Framework_TestCase
{

    const NB_OF_PARALLEL_REQUESTS = 2;

    /**
     * @var BatchRequestManager
     */
    protected $batchRequestManager;

    /**
     * @var Client mock
     */
    protected $client;

    /**
     * @var Request mock
     */
    protected $request;

    protected function setUp()
    {
	$this->client = Mockery::mock('GuzzleHttp\Client');
	$this->request = Mockery::mock('GuzzleHttp\Message\Request');

	$this->batchRequestManager = new BatchRequestManager($this->client, self::NB_OF_PARALLEL_REQUESTS);
    }

    protected function tearDown()
    {
	Mockery::close();
    }

    public function test()
    {

    }

}
