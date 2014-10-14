<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium\utils;

use Iterator;

class JsonIterator implements Iterator
{

    protected $needle;
    protected $jsonString;
    protected $cursorPosition;
    protected $nextCursorPosition;

    public function __construct($jsonString, $firstTopLevelString = null, $jsonStringHasSquareBrackets = false)
    {
	$this->jsonString = $jsonString;

	if ($jsonStringHasSquareBrackets)
	{
	    $this->jsonString = substr($this->jsonString, 1, -1);
	}

	$this->needleFactory($firstTopLevelString);
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
	$this->getNextCursorPosition();
	$elementLength = ($this->nextCursorPosition - $this->cursorPosition);
	$currentElement = substr($this->jsonString, $this->cursorPosition, $elementLength);

	return json_decode($currentElement, true);
    }

    /**
     * {@inheritDoc}
     */
    public function key()
    {
	return null;
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
	$this->cursorPosition = ($this->nextCursorPosition + 1);
    }

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
	$this->cursorPosition = 0;
    }

    /**
     * {@inheritDoc}
     */
    public function valid()
    {
	if ($this->cursorPosition >= strlen($this->jsonString))
	{
	    return false;
	}

	return true;
    }

    protected function needleFactory($firstTopLevelString = null)
    {
	$this->needle = ',{';

	if ($firstTopLevelString != null)
	{
	    $this->needle .= '"' . $firstTopLevelString . '"';
	}
    }

    protected function getNextCursorPosition()
    {
	$this->nextCursorPosition = strpos($this->jsonString, $this->needle, $this->cursorPosition);

	if ($this->nextCursorPosition == false)
	{
	    $this->nextCursorPosition = strlen($this->jsonString);
	}

	return $this->nextCursorPosition;
    }

    public function __destruct()
    {
	unset($this->jsonString);
	$this->jsonString = '';
    }

}
