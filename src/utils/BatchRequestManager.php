<?php

/*
 * Copyright (c) 2014, Etienne Lamoureux
 * All rights reserved.
 * Distributed under the BSD 3-Clause license (http://opensource.org/licenses/BSD-3-Clause).
 */
namespace EtienneLamoureux\DurmandScriptorium\utils;

class BatchRequestManager
{

    public function __construct()
    {

    }

    public function executeRequests($requests)
    {
	$this->client->sendAll($requests, [
	    // Call this function when each request completes
	    'complete' => function (CompleteEvent $event)
	    {
		echo 'Completed request to ' . $event->getRequest()->getUrl() . "\n";
		echo 'Response: ' . $event->getResponse()->getBody() . "\n\n";
	    },
	    // Call this function when a request encounters an error
	    'error' => function (ErrorEvent $event)
	    {
		echo 'Request failed: ' . $event->getRequest()->getUrl() . "\n";
		echo $event->getException();
	    },
	    // Maintain a maximum pool size of 25 concurrent requests.
	    'parallel' => 25
	]);
    }

}
