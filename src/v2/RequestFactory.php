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
    protected $supportsLocalization;

    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client, $endpointUrl, $supportsLocalization = false)
    {
	$this->client = $client;
	$this->ENDPOINT_URL = $endpointUrl;
	$this->supportsLocalization = $supportsLocalization;
    }

    public function baseRequest()
    {
	$request = $this->buildBaseRequest($this->client);

	return $request;
    }

    protected function buildBaseRequest()
    {
	$request = $this->client->createRequest(Settings::GET, Settings::BASE_URL . $this->ENDPOINT_URL, Settings::$CREATE_REQUEST_OPTIONS);

	if ($this->supportsLocalization)
	{
	    $query = $request->getQuery();
	    $query->set(Settings::LANG, Settings::$LOCALE);
	}

	return $request;
    }

}
