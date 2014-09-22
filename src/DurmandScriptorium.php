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

    protected $quaggans;

    public function __construct()
    {
	$this->quaggans = new CollectionApiConsumer(new CollectionApiRequestFactory('/v2/quaggans'));
    }

    public function getAllQuaggans($expanded = false)
    {
	if ($expanded)
	{
	    $data = $this->quaggans->getAllExpanded();
	}
	else
	{
	    $data = $this->quaggans->getAll();
	}

	return $data;
    }

    public function getQuaggan($id)
    {
	return $this->quaggans->get($id);
    }

    public function getQuaggans($ids)
    {
	return $this->quaggans->getSome($ids);
    }

}
