<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\utils;

use AppendIterator;

class JsonFilesIterator extends AppendIterator
{

    public function __construct($jsonFileHandles, $firstTopLevelString = null, $jsonStringHasSquareBrackets = true)
    {
	parent::__construct();

	foreach ($jsonFileHandles as $jsonFileHandle)
	{
	    $this->append(new JsonFileIterator($jsonFileHandle, $firstTopLevelString, $jsonStringHasSquareBrackets));
	}
    }

}
