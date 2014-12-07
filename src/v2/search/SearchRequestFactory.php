<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\v2\search;

use Crystalgorithm\DurmandScriptorium\utils\Settings;
use Crystalgorithm\DurmandScriptorium\v2\RequestFactory;
use InvalidArgumentException;

class SearchRequestFactory extends RequestFactory
{

    public function searchRequest($id, $argument = Settings::INPUT)
    {
	if ($id <= 0)
	{
	    throw new InvalidArgumentException('Id must be greater than 0. Input was: ' . $id);
	}

	$request = $this->buildBaseRequest();
	$query = $request->getQuery();
	$query->set($argument, $id);

	return $request;
    }

}
