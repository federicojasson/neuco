<?php

/*
 * This script serves an external request.
 */

// Defines the root path
define('ROOT_DIRECTORY', __DIR__);

// Includes the application
require ROOT_DIRECTORY . '/private/scripts/application.php';

// Serves the external request
serveExternalRequest();
