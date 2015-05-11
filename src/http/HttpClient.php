<?php

use Crystalgorithm\DurmandScriptorium\utils\Request;

namespace Crystalgorithm\DurmandScriptorium\http;

interface HttpClient
{

    public function buildGetRequest($method, $url, array $options = []);

    public function sendRequest(Request $request);

    public function sendRequests(array $request);
}
