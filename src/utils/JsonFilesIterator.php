<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\utils;

use MultipleIterator;

class JsonFilesIterator extends MultipleIterator
{

    public function __construct($jsonFileHandles, $firstTopLevelString = null, $jsonStringHasSquareBrackets = true, $flags = null)
    {
	foreach ($jsonFileHandles as $jsonFileHandle)
	{
	    $this->attachIterator(new JsonFileIterator($jsonFileHandle, $firstTopLevelString, $jsonStringHasSquareBrackets));
	}

	parent::__construct($flags);
    }

}
