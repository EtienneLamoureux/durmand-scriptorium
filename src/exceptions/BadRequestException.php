<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\exceptions;

class BadRequestException extends \RuntimeException
{

    public function __construct($message, $code = 0, \Exception $previous = null)
    {
	if (!isset($message) || $message == null)
	{
	    $message = "GW2 API returned a code 400.";
	}

	parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
	return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

}
