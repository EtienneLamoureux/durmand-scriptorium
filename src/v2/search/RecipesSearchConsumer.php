<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\v2\search;

use Crystalgorithm\DurmandScriptorium\Consumer;
use Crystalgorithm\DurmandScriptorium\utils\Settings;
use Crystalgorithm\DurmandScriptorium\v2\search\SearchConsumer;

/**
 * @link https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/RECIPES_SEARCH_CONSUMER.md documentation
 */
class RecipesSearchConsumer extends Consumer implements SearchConsumer
{

    /**
     * {@inheritdoc}
     */
    public function search($id)
    {
	$inputRequest = $this->requestFactory->searchRequest($id, Settings::INPUT);
	$data[Settings::INPUT] = $this->getDataFromApi($inputRequest);

	$outputRequest = $this->requestFactory->searchRequest($id, Settings::OUTPUT);
	$data[Settings::OUTPUT] = $this->getDataFromApi($outputRequest);

	return $data;
    }

}
