<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace EtienneLamoureux\DurmandScriptorium;

use EtienneLamoureux\DurmandScriptorium\v2\CollectionApiConsumer;
use EtienneLamoureux\DurmandScriptorium\v2\CollectionApiRequestFactory;

class DurmandScriptorium
{

    public static $quaggansEndpointUrl = '/v2/quaggans';
    public static $listingsEndpointUrl = '/v2/commerce/listings';
    protected $quaggans;
    protected $listings;

    public function __construct()
    {
	$quaggansRequestFactory = new CollectionApiRequestFactory(DurmandScriptorium::$quaggansEndpointUrl);
	$this->quaggans = new CollectionApiConsumer($quaggansRequestFactory);

	$listingsRequestFactory = new CollectionApiRequestFactory(DurmandScriptorium::$listingsEndpointUrl);
	$this->listings = new CollectionApiConsumer($listingsRequestFactory);
    }

    public function getAllQuaggans($expanded = false)
    {
	return $this->getAllElements($this->quaggans);
    }

    public function getQuaggan($id)
    {
	return $this->getElement($this->quaggans, $id);
    }

    public function getQuaggans($ids)
    {
	return $this->getElements($this->quaggans, $ids);
    }

    public function getAllListings($expanded = false)
    {
	return $this->getAllElements($this->listings);
    }

    public function getListing($id)
    {
	return $this->getElement($this->listings, $id);
    }

    public function getListings($ids)
    {
	return $this->getElements($this->listings, $ids);
    }

    private function getAllElements($apiConsumer, $expanded = false)
    {
	if ($expanded)
	{
	    $data = $apiConsumer->getAllExpanded();
	}
	else
	{
	    $data = $apiConsumer->getAll();
	}

	return $data;
    }

    private function getElement($apiConsumer, $id)
    {
	return $apiConsumer->get($id);
    }

    private function getElements($apiConsumer, $ids)
    {
	return $apiConsumer->getSome($ids);
    }

}
