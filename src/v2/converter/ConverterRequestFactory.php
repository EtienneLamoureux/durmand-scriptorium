<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\v2\converter;

use Crystalgorithm\DurmandScriptorium\v2\RequestFactory;
use InvalidArgumentException;

class ConverterRequestFactory extends RequestFactory
{

    const QUANTITY = 'quantity';

    public function conversionRequest($quantity)
    {
	if ($quantity <= 0)
	{
	    throw new InvalidArgumentException('Quantity must be positive. Input was: ' . $quantity);
	}

	$request = $this->buildBaseRequest();
	$query = $request->getQuery();
	$query->set(self::QUANTITY, $quantity);
	var_dump($request);
	return $request;
    }

}
