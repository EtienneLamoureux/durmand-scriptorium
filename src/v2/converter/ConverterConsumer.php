<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace Crystalgorithm\DurmandScriptorium\v2\converter;

use Crystalgorithm\DurmandScriptorium\Consumer;

class ConverterConsumer extends Consumer
{

    public function convert($quantity)
    {
	$request = $this->requestFactory->conversionRequest($quantity);
	$data = $this->getDataFromApi($request);

	return $data;
    }

}
