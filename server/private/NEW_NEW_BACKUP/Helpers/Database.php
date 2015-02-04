<?php

namespace App\Helpers;

/*
 * This helper represents a database and offers basic operations to communicate
 * with it.
 * 
 * Subclasses must implement the connect function and the necessary queries.
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
			// Commits the current transaction
			$this->pdo->exec('COMMIT');
		} catch (\PDOException $exception) {
			// A PDO exception was thrown
			$app->error($exception);
		}
	}
	
	/*
	 * Rolls back the current transaction.
	 */
	public function rollBackTransaction() {
		$app = $this->app;
		
		try {
			// Rolls back the current transaction
			$this->pdo->exec('ROLLBACK');
		} catch (\PDOException $exception) {
			// A PDO exception was thrown
			$app->error($exception);
		}
	}
	
	/*
	 * Starts a read-only transaction.
	 */
	public function startReadOnlyTransaction() {
		$app = $this->app;
		
		try {
			// Starts a read-only transaction
			$this->pdo->exec('START TRANSACTION READ ONLY');
		} catch (\PDOException $exception) {
			// A PDO exception was thrown
			$app->error($exception);
		}
	}
	
	/*
	 * Starts a read-write transaction.
	 */
	public function startReadWriteTransaction() {
		$app = $this->app;
		
		try {
			// Starts a read-write transaction
			$this->pdo->exec('START TRANSACTION READ WRITE');
		} catch (\PDOException $exception) {
			// A PDO exception was thrown
			$app->error($exception);
		}
	}
	
	/*
	 * Connects to the database.
	 * 
	 * It returns a PDO instance representing the connection.
	 */
	protected abstract function connect();
	
	/*
	 * Executes a prepared statement and returns the results. If the statement
	 * is not a query, null is returned.
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
		} catch (\PDOException $exception) {
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

			// Configures the PDO
			$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
			$pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
			$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			
			// Sets the isolation level for the transactions
			$pdo->exec('SET SESSION TRANSACTION ISOLATION LEVEL SERIALIZABLE');
			
			// Initializes the instance attribute
			$this->pdo = $pdo;
		} catch (\PDOException $exception) {
			// A PDO exception was thrown
			$app->error($exception);
		}
	}
	
}