<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\v2\collection;

use Crystalgorithm\DurmandScriptorium\CollectionConsumer;
use Crystalgorithm\DurmandScriptorium\Consumer;
use Crystalgorithm\DurmandScriptorium\exceptions\BadRequestException;
use Crystalgorithm\DurmandScriptorium\utils\BatchRequestManager;
use Crystalgorithm\DurmandScriptorium\utils\Settings;
use Crystalgorithm\DurmandScriptorium\v2\RequestFactory;
use Crystalgorithm\PhpJsonIterator\JsonIteratorFactory;
use GuzzleHttp\Client;

class PaginatedCollectionConsumer extends Consumer implements CollectionConsumer
{

    public function __construct(Client $client, RequestFactory $requestFactory, BatchRequestManager $batchRequestManager, JsonIteratorFactory $jsonIteratorFactory, $idString = null)
    {
	parent::__construct($client, $requestFactory, $batchRequestManager, $jsonIteratorFactory);
	$this->idString = $idString;
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
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

    /**
     * @link https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/COLLECTION_CONSUMER.md#getpagerange documentation
     * @param int $pageSize
     * @return array
     */
    public function getPageRange($pageSize = null)
    {
	$request = $this->requestFactory->pageRequest(Settings::FIRST_PAGE_NB, $pageSize);
	$response = $this->getResponse($request);
	$totalNbOfPages = $response->getHeader(Settings::TOTAL_PAGE_HEADER);

	$pageRange = ['first' => Settings::FIRST_PAGE_NB, 'last' => ($totalNbOfPages - 1)];

	return $pageRange;
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
	$pageRange = $this->getPageRange(Settings::MAX_PAGE_SIZE);

	$requests = $this->buildPagesRequests($pageRange['first'], $pageRange['last']);
	$iterator = $this->getDataFromApi($requests);

	return $iterator;
    }

    protected function buildPagesRequests($firstPage, $lastPage)
    {
	$requests = array();

	for ($currentPage = $firstPage; $currentPage <= $lastPage; $currentPage++)
	{
	    $requests[] = $this->requestFactory->pageRequest($currentPage, Settings::MAX_PAGE_SIZE);
	}

	return $requests;
    }

}
