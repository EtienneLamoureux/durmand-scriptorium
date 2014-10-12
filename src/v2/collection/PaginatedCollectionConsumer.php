<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\v2\collection;

use Crystalgorithm\DurmandScriptorium\CollectionConsumer;
use Crystalgorithm\DurmandScriptorium\Consumer;
use Crystalgorithm\DurmandScriptorium\utils\Settings;

class PaginatedCollectionConsumer extends Consumer implements CollectionConsumer
{

    public function get($id)
    {
	if (is_array($id))
	{
	    return $this->getMany($id);
	}

	$request = $this->requestFactory->idRequest($id);
	$data = $this->getDataFromApi($request);

	return $data;
    }

    public function getAll($expanded = false)
    {
	if ($expanded)
	{
	    return $this->getAllPages();
	}

	$request = $this->requestFactory->baseRequest();
	$data = $this->getDataFromApi($request);

	return $data;
    }

    /**
     * @link https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/COLLECTION_CONSUMER.md#getpage documentation
     * @param int $page
     * @param int $pageSize
     * @return array
     * @throws BadRequestException
     */
    public function getPage($page, $pageSize = null)
    {
	$request = $this->requestFactory->pageRequest($page, $pageSize);
	$data = $this->getDataFromApi($request);

	return $data;
    }

    protected function getMany(array $ids)
    {
	if (sizeof($ids) <= 0)
	{
	    return array();
	}

	$request = $this->requestFactory->idsRequest($ids);
	$data = $this->getDataFromApi($request);

	return $data;
    }

    protected function getAllPages()
    {
	$page = 0;
	$request = $this->requestFactory->pageRequest($page, Settings::MAX_PAGE_SIZE);
	$response = $this->getResponse($request);
	$totalNbOfPages = $response->getHeader(Settings::TOTAL_PAGE_HEADER);

	$requests = $this->buildPagesRequests(1, $totalNbOfPages);
	$responses = $this->getResponse($requests);
	$responses[] = $response;
	$phpArray = $this->convertResponseToArray($responses);

	return $phpArray;
    }

    protected function buildPagesRequests($firstPage, $lastPage)
    {
	$requests = array();

	for ($currentPage = $firstPage; $currentPage < $lastPage; $currentPage++)
	{
	    $requests[] = $this->requestFactory->pageRequest($currentPage, Settings::MAX_PAGE_SIZE);
	}

	return $requests;
    }

}
