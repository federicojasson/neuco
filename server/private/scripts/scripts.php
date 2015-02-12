<?php

/*
 * This script initializes the application's scripts.
 */

// Classes
spl_autoload_register('onClassReference');

// Resources
require __DIR__ . '/resources/constants.php';
require __DIR__ . '/resources/functions.php';

// Vendors
require __DIR__ . '/vendors/PHPMailer/PHPMailerAutoload.php';
require __DIR__ . '/vendors/Slim/Slim.php'; \Slim\Slim::registerAutoloader();

/*
 * Invoked when a class is referenced and has not been defined yet.
 * 
 * It receives the class.
 */
function onClassReference($class) {
	// Initializes the application's namespace and its length
	$applicationNamespace = 'App\\';
	$length = strlen($applicationNamespace);

	// Gets the class' prefix and suffix
	$prefix = substr($class, 0, $length);
	$suffix = substr($class, $length);

	if ($prefix !== $applicationNamespace) {
		// The class don't belong to the application's namespace
		return;
	}

	// Builds the file's path
	$path = __DIR__ . '/classes/' . str_replace('\\', '/', $suffix) . '.php';

	if (file_exists($path)) {
		// The file exists: it includes it
		require $path;
	}
}
