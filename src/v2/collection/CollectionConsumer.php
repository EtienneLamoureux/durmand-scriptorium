<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\v2\collection;

use Crystalgorithm\DurmandScriptorium\Consumer;
use Crystalgorithm\DurmandScriptorium\utils\Settings;

class CollectionConsumer extends Consumer
{

    public function get($id)
    {
	if (is_array($id))
	{
	    if (sizeof($id) <= 0)
	    {
		return array();
	    }

	    $data = $this->getMany($id);
	}
	else
	{
	    $request = $this->requestFactory->idRequest($id);
	    $data = $this->getDataFromApi($request);
	}

	return $data;
    }

    public function getAll($expanded = false)
    {
	if ($expanded)
	{
	    $data = $this->getAllPages();
	}
	else
	{
	    $request = $this->requestFactory->baseRequest();
	    $data = $this->getDataFromApi($request);
	}

	return $data;
    }

    public function getPage($page, $pageSize = null)
    {
	$request = $this->requestFactory->pageRequest($page, $pageSize);
	$data = $this->getDataFromApi($request);

	return $data;
    }

    protected function getMany(array $ids)
    {
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

	$requests = $this->buildPagesRequests($totalNbOfPages);
	$responses = $this->getResponse($requests);
	$responses[] = $response;
	$phpArray = $this->convertResponseToArray($responses);

	return $phpArray;
    }

    protected function buildPagesRequests($totalNbOfPages)
    {
	$requests = array();

	for ($currentPage = 1; $currentPage < $totalNbOfPages; $currentPage++)
	{
	    $requests[] = $this->requestFactory->pageRequest($currentPage, Settings::MAX_PAGE_SIZE);
	}

	return $requests;
    }

}
