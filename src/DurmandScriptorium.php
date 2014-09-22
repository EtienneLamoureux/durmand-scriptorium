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

    public function quaggans()
    {
	return $this->quaggans;
    }

    public function listings()
    {
	return $this->listings;
    }

}
