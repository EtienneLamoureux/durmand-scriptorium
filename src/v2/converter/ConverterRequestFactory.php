<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
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
