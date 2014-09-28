<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace Crystalgorithm\DurmandScriptorium\v2;

use Crystalgorithm\DurmandScriptorium\Consumer;
use Crystalgorithm\DurmandScriptorium\utils\Constants;

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
	$request = $this->requestFactory->pageRequest($page, Constants::MAX_PAGE_SIZE);
	$response = $this->getResponse($request);
	$totalNbOfPages = $response->getHeader('x-page-total');

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
	    $requests[] = $this->requestFactory->pageRequest($currentPage, Constants::MAX_PAGE_SIZE);
	}

	return $requests;
    }

}
