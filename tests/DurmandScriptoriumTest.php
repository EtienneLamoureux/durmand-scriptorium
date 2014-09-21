<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
use EtienneLamoureux\DurmandScriptorium\DurmandScriptorium;

class DurmandScriptoriumTest extends PHPUnit_Framework_TestCase
{

    public function testWorks()
    {
	$durmandScriptorium = new DurmandScriptorium;
	$this->assertTrue($durmandScriptorium->testMethod());
    }

}
