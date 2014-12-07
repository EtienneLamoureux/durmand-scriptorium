<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\v2\search;

/**
 * @link https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/SEARCH_CONSUMER.md documentation
 */
interface SearchConsumer
{

    /**
     * @link https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/SEARCH_CONSUMER.md#search documentation
     * @param int $id
     * @return array
     */
    public function search($id);
}
