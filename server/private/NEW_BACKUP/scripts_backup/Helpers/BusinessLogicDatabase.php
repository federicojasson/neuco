<?php

namespace App\Helpers;

/*
 * This helper represents the business logic database.
 */
class BusinessLogicDatabase extends \App\Helpers\Database {
	
	/*
	 * Connects to the database.
	 * 
	 * It returns a PDO instance representing the connection.
	 */
	protected function connect() {
		$app = $this->app;
		
		// Gets the database's parameters
		$parameters = $app->parameters->get(PARAMETERS_DATABASES);
		$businessLogicDatabase = $parameters['businessLogicDatabase'];
		$dsn = $businessLogicDatabase['dsn'];
		$username = $businessLogicDatabase['username'];
		$password = $businessLogicDatabase['password'];
		
		// Creates and returns the PDO instance
		return new \PDO($dsn, $username, $password);
	}
	
}