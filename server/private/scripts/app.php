<?php

/**
 * ETRS - Eye Tracking Record System
 * Copyright (C) 2015 Federico Jasson
 * 
 * This program is free software: you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option) any later
 * version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * This script includes the scripts of the application and defines bootstrapping
 * functions.
 */

// Defines the directories
define('DIRECTORY_LOGS', DIRECTORY_ROOT . '/private/logs');
define('DIRECTORY_PARAMETERS', DIRECTORY_ROOT . '/private/parameters');
define('DIRECTORY_SCRIPTS', DIRECTORY_ROOT . '/private/scripts');
define('DIRECTORY_VENDORS', DIRECTORY_ROOT . '/private/vendors');

// Includes the vendors
require_once DIRECTORY_VENDORS . '/Doctrine2/autoload.php';
require_once DIRECTORY_VENDORS . '/PHPMailer/PHPMailerAutoload.php';
require_once DIRECTORY_VENDORS . '/Slim/Slim.php'; \Slim\Slim::registerAutoloader();

// Includes the resources
require_once DIRECTORY_SCRIPTS . '/resources/constants.php';
require_once DIRECTORY_SCRIPTS . '/resources/functions.php';

// Registers a class autoloader
spl_autoload_register('loadClass');

// Defines the operation mode
define('OPERATION_MODE', OPERATION_MODE_DEVELOPMENT);
//define('OPERATION_MODE', OPERATION_MODE_MAINTENANCE);
//define('OPERATION_MODE', OPERATION_MODE_PRODUCTION);

/**
 * Executes a cron job.
 * 
 * Receives the URL of the requested service.
 */
function executeCronJob($url) {
	if (OPERATION_MODE === OPERATION_MODE_MAINTENANCE) {
		// The system is under maintenance
		
		// Shows an informative message
		echo 'The system is under maintenance';
		
		// Exits the application
		exit();
	}
	
	// Serves the internal request
	serveInternalRequest($url);
}

/**
 * Executes a maintenance job.
 * 
 * Receives the URL of the requested service.
 */
function executeMaintenanceJob($url) {
	if (OPERATION_MODE !== OPERATION_MODE_MAINTENANCE) {
		// The system is not under maintenance
		
		// Shows an informative message
		echo 'The system is not under maintenance';
		
		// Exits the application
		exit();
	}
	
	// Serves the internal request
	serveInternalRequest($url);
}

/**
 * Executes a server job.
 */
function executeServerJob() {
	if (OPERATION_MODE === OPERATION_MODE_MAINTENANCE) {
		// The system is under maintenance
		
		// Defines the response
		$response = [
			'code' => CODE_SYSTEM_UNDER_MAINTENANCE
		];
		
		// Sends the response with the appropriate headers
		http_response_code(HTTP_STATUS_SERVICE_UNAVAILABLE);
		header('Content-Type: application/json');
		echo json_encode($response);
		
		// Exits the application
		exit();
	}
	
	// Serves the external request
	serveExternalRequest();
}

/**
 * Includes a class if the corresponding script exists.
 * 
 * Receives the fully-qualified class name.
 */
function loadClass($class) {
	// Defines the namespace of the application and gets its length
	$namespace = 'App\\';
	$length = strlen($namespace);

	// Gets the prefix and the suffix of the class
	$prefix = substr($class, 0, $length);
	$suffix = substr($class, $length);

	if ($prefix !== $namespace) {
		// The class doesn't belong to the application
		return;
	}

	// Builds the script's path
	$path = '';
	$path .= DIRECTORY_SCRIPTS . '/classes';
	$path .= '/' . str_replace('\\', '/', $suffix) . '.php';

	if (file_exists($path)) {
		// The script exists
		// Includes the script
		require_once $path;
	}
}

/**
 * Registers a set of middlewares and runs the application.
 * 
 * Receives the middlewares.
 */
function runApp($middlewares) {
	global $app;
	
	// Initializes the application
	$app = new \Slim\Slim([
		'mode' => OPERATION_MODE
	]);

	// Registers the middlewares
	foreach ($middlewares as $middleware) {
		$app->add($middleware);
	}
	
	// Runs the application
	$app->run();
}

/**
 * Serves an external request.
 */
function serveExternalRequest() {
	// Defines the services
	$services = [
		'/account/sign-in',
		'/account/sign-out',
		'/authentication/get-state',
		'/medication/create',
		'/medication/delete',
		'/medication/edit',
		'/medication/get',
		'/medication/search',
		'/permission/reset-password/request'
	];
	
	// Initializes the middlewares
	$middlewares = [
		new \App\Middleware\Session(),
		new \App\Middleware\Services($services),
		new \App\Middleware\Configurations(),
		new \App\Middleware\Helpers(),
		new \App\Middleware\ErrorHandlers()
	];
	
	// Runs the application
	runApp($middlewares);
}

/**
 * Serves an internal request.
 * 
 * Receives the URL of the requested service.
 */
function serveInternalRequest($url) {
	// Mocks the environment to simulate an HTTP request
	\Slim\Environment::mock([
		'PATH_INFO' => $url,
		'REQUEST_METHOD' => 'POST'
	]);
	
	// Defines the services
	$services = [
		'/session/delete-expired',
		'/user/delete'
	];
	
	// Initializes the middlewares
	$middlewares = [
		new \App\Middleware\Services($services),
		new \App\Middleware\Configurations(),
		new \App\Middleware\Helpers(),
		new \App\Middleware\ErrorHandlers()
	];
	
	// Runs the application
	runApp($middlewares);
}