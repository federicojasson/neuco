<?php

namespace App\Helpers;

/*
 * This helper represents a database and offers convenient methods to
 * communicate with it.
 * 
 * Subclasses must define the connection parameters and implement the queries.
 */
abstract class Database extends \App\Helpers\Helper {
	
	/*
	 * The PDO instance that represents the connection with the database.
	 */
	private $pdo;
	
	/*
	 * Commits the current transaction.
	 */
	public function commitTransaction() {
		$app = $this->app;
		
		try {
			$this->pdo->commit();
		} catch (PDOException $exception) {
			// A PDO exception was thrown
			$app->error($exception);
		}
	}
	
	/*
	 * Selects and returns the number of rows found in the last query.
	 */
	public function selectFoundRows() {
		// Defines the statement
		$statement = 'SELECT FOUND_ROWS() AS foundRows';
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement);
		
		// Returns the result
		return $results[0]['foundRows'];
	}
	
	/*
	 * Starts a transaction.
	 */
	public function startTransaction() {
		$app = $this->app;
		
		try {
			$this->pdo->beginTransaction();
		} catch (PDOException $exception) {
			// A PDO exception was thrown
			$app->error($exception);
		}
	}
	
	/*
	 * Connects to the database.
	 * 
	 * It returns the PDO instance representing the connection.
	 */
	protected abstract function connect();
	
	/*
	 * Executes a prepared statement and returns the results, or null if the
	 * statement is not a query.
	 * 
	 * It receives the statement and, optionally, the parameters to prepare it.
	 */
	protected function executePreparedStatement($statement, $parameters = null) {
		$app = $this->app;
		
		try {
			// Prepares and executes the statement
			$preparedStatement = $this->pdo->prepare($statement);
			$preparedStatement->execute($parameters);
			
			if ($preparedStatement->columnCount() === 0) {
				// The statement is not a query
				return null;
			}
			
			// Fetches and returns the results
			return $preparedStatement->fetchAll();
		} catch (PDOException $exception) {
			// A PDO exception was thrown
			$app->error($exception);
		}
	}
	
	/*
	 * Performs initialization tasks.
	 */
	protected function initialize() {
		$app = $this->app;
		
		try {
			// Connects to the database
			$pdo = $this->connect();

			// Configures the PDO instance
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // TODO: test erros and configure this

			$this->pdo = $pdo;
		} catch (PDOException $exception) {
			// A PDO exception was thrown
			$app->error($exception);
		}
	}
	
}