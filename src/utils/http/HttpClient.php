<?php

use Crystalgorithm\DurmandScriptorium\utils\http\Request;

namespace Crystalgorithm\DurmandScriptorium\utils\http;

interface HttpClient
{

    public function sendRequest(Request $request);

    public function sendRequests(array $request);
}
