<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
use EtienneLamoureux\DurmandScriptorium\DurmandScriptorium;

class QuaggansTest extends PHPUnit_Framework_TestCase
{

    protected static $api;

    public static function setUpBeforeClass()
    {
	parent::setUpBeforeClass();
	QuaggansTest::$api = new DurmandScriptorium();
    }

    public function testClientCanReachApi()
    {
	$data = QuaggansTest::$api->getQuaggans();

	$this->assertNotNull($data);
    }

}
