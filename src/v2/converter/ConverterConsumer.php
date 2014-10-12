<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\v2\converter;

use Crystalgorithm\DurmandScriptorium\Consumer;

/**
 * @link https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/CONVERTER_CONSUMER.md documentation
 */
class ConverterConsumer extends Consumer
{

    /**
     * @link https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/CONVERTER_CONSUMER.md#convert documentation
     * @param int $quantity
     * @return array
     */
    public function convert($quantity)
    {
	$request = $this->requestFactory->conversionRequest($quantity);
	$data = $this->getDataFromApi($request);

	return $data;
    }

}
