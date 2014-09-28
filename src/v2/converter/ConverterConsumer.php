<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
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
