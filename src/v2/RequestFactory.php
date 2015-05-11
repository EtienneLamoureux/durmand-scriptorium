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
     * @var HttpClient
     */
    protected $httpClient;

    public function __construct(HttpClient $httpClient, $endpointUrl, $supportsLocalization = false)
    {
	$this->httpClient = $httpClient;
	$this->ENDPOINT_URL = $endpointUrl;
	$this->supportsLocalization = $supportsLocalization;
    }

    public function buildBaseRequest()
    {
	$request = $this->httpClient->buildGetRequest(Settings::GET, Settings::BASE_URL . $this->ENDPOINT_URL, Settings::$CREATE_REQUEST_OPTIONS);

	localizeRequest($request);

	return $request;
    }

    protected function localizeRequest($request)
    {
	if ($this->supportsLocalization)
	{
	    $query = $request->getQuery();
	    $query->set(Settings::LANG, Settings::$LOCALE);
	}
    }

}
