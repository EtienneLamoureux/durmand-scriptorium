<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium;

use Crystalgorithm\DurmandScriptorium\exceptions\BadRequestException;
use InvalidArgumentException;

/**
 * @link https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/COLLECTION_CONSUMER.md#collection-consumer documentation
 */
interface CollectionConsumer
{

    /**
     * @link https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/COLLECTION_CONSUMER.md#get documentation
     * @param int|string $id
     * @return array
     * @throws InvalidArgumentException
     * @throws BadRequestException
     */
    public function get($id);

    /**
     * @link https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/COLLECTION_CONSUMER.md#getall documentation
     * @param bool $expanded
     * @return array
     */
    public function getAll($expanded);
}
