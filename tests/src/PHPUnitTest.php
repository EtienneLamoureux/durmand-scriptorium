<?php

/*
 * @author Etienne Lamoureux <etienne.lamoureux@crystalgorithm.com>
 * @copyright 2014 Etienne Lamoureux
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Crystalgorithm\DurmandScriptorium;

use Mockery;
use PHPUnit_Framework_TestCase;

abstract class PHPUnitTest extends PHPUnit_Framework_TestCase
{

    public function tearDown()
    {
	Mockery::close();
    }

    public function mock($class)
    {
	$mock = Mockery::mock($class);

	return $mock;
    }

}
