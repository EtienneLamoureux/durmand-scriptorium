<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\utils;

class Utils
{

    public static function mergeArrays(&$masterArray, &$arrayToMerge)
    {
	$i = 0;

	while (isset($arrayToMerge[$i]))
	{
	    $masterArray[] = $arrayToMerge[$i];
	    unset($arrayToMerge[$i]);
	    $i++;
	}
    }

}
