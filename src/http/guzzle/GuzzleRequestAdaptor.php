<?php

namespace Crystalgorithm\DurmandScriptorium\http\guzzle;

use GuzzleHttp\Message\Request;

class GuzzleRequestAdaptor implements HttpRequest
{

    private $guzzleRequest;

    public function __construct(Request $guzzleRequest)
    {
	$this->guzzleRequest = $guzzleRequest;
    }

}
