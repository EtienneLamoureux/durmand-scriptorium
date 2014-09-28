<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace Crystalgorithm\DurmandScriptorium\v2\converter;

use Crystalgorithm\DurmandScriptorium\v2\RequestFactory;

class ConverterRequestFactory extends RequestFactory
{

    public function conversionRequest($quantity)
    {
	$request = $this->buildBaseRequest();
	$query = $request->getQuery();
	$query->set('quantity', $quantity);

	return $request;
    }

}
