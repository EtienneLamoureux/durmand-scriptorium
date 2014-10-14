<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\v2;

use Crystalgorithm\DurmandScriptorium\utils\Settings;
use GuzzleHttp\Client;

abstract class RequestFactory
{

    protected $ENDPOINT_URL = '';

    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client, $endpointUrl)
    {
	$this->client = $client;
	$this->ENDPOINT_URL = $endpointUrl;
    }

    public function baseRequest()
    {
	$request = $this->buildBaseRequest($this->client);

	return $request;
    }

    protected function buildBaseRequest()
    {
	return $this->client->createRequest(Settings::GET, Settings::BASE_URL . $this->ENDPOINT_URL, Settings::$CREATE_REQUEST_OPTIONS);
    }

}
