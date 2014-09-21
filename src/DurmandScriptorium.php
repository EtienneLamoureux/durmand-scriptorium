<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace EtienneLamoureux\DurmandScriptorium;

use EtienneLamoureux\DurmandScriptorium\v2\quaggans\QuaggansApiConsumer;

class DurmandScriptorium
{

    protected $quaggans;

    public function __construct()
    {
	$this->quaggans = new QuaggansApiConsumer();
    }

    public function getQuaggans($expanded = false)
    {
	if ($expanded)
	{
	    $data = $this->quaggans->getExpandedQuaggans();
	}
	else
	{
	    $data = $this->quaggans->getQuaggans();
	}

	return $data;
    }

    public function getQuaggan($id)
    {
	return $this->quaggans->getQuaggan($id);
    }

}
