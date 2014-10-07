<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\v2\converter;

use Crystalgorithm\DurmandScriptorium\utils\Settings;
use Crystalgorithm\DurmandScriptorium\v2\RequestFactory;
use InvalidArgumentException;

class ConverterRequestFactory extends RequestFactory
{

    public function conversionRequest($quantity)
    {
	if ($quantity <= 0)
	{
	    throw new InvalidArgumentException('Quantity must be greater than 0. Input was: ' . $quantity);
	}

	$request = $this->buildBaseRequest();
	$query = $request->getQuery();
	$query->set(Settings::QUANTITY, $quantity);

	return $request;
    }

}
