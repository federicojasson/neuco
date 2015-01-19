<?php

namespace App\Helpers;

/*
 * This helper represents the business logic database.
 */
class BusinessLogicDatabase extends \App\Helpers\Database {
	
	/*
	 * Creates an experiment.
	 * 
	 * It receives the experiment's data.
	 */
	public function createExperiment($id, $creator, $lastEditor, $name, $commandLine) {
		// Defines the statement
		$statement = '
			INSERT INTO experiments (
				id,
				is_erased,
				creator,
				last_editor,
				creation_datetime,
				last_edition_datetime,
				name,
				command_line
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				:lastEditor,
				UTC_TIMESTAMP(),
				UTC_TIMESTAMP(),
				:name,
				:commandLine
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':lastEditor' => $lastEditor,
			':name' => $name,
			':commandLine' => $commandLine
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Creates a medication.
	 * 
	 * It receives the medication's data.
	 */
	public function createMedication($id, $creator, $lastEditor, $name) {
		// Defines the statement
		$statement = '
			INSERT INTO medications (
				id,
				is_erased,
				creator,
				last_editor,
				creation_datetime,
				last_edition_datetime,
				name
			)
			VALUES (
				:id,
				FALSE,
				:creator,
				:lastEditor,
				UTC_TIMESTAMP(),
				UTC_TIMESTAMP(),
				:name
			)
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':creator' => $creator,
			':lastEditor' => $lastEditor,
			':name' => $name
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Edits an experiment.
	 * 
	 * It receives the experiment's data.
	 */
	public function editExperiment($id, $lastEditor, $name, $commandLine) {
		// Defines the statement
		$statement = '
			UPDATE experiments
			SET
				last_editor = :lastEditor,
				last_edition_datetime = UTC_TIMESTAMP(),
				name = :name,
				command_line = :commandLine
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':lastEditor' => $lastEditor,
			':name' => $name,
			':commandLine' => $commandLine
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Edits a medication.
	 * 
	 * It receives the medication's data.
	 */
	public function editMedication($id, $lastEditor, $name) {
		// Defines the statement
		$statement = '
			UPDATE medications
			SET
				last_editor = :lastEditor,
				last_edition_datetime = UTC_TIMESTAMP(),
				name = :name
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id,
			':lastEditor' => $lastEditor,
			':name' => $name
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Erases an experiment.
	 * 
	 * It receives the experiment's ID.
	 */
	public function eraseExperiment($id) {
		// Defines the statement
		$statement = '
			UPDATE experiments
			SET is_erased = TRUE
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Erases the files of an experiment.
	 * 
	 * It receives the experiment's ID.
	 */
	public function eraseExperimentFiles($id) {
		// Defines the statement
		$statement = '
			UPDATE files
			INNER JOIN experiments_files ON files.id = experiments_files.file
			SET files.is_erased = TRUE
			WHERE experiments_files.experiment = :id
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Erases a medication.
	 * 
	 * It receives the medication's ID.
	 */
	public function eraseMedication($id) {
		// Defines the statement
		$statement = '
			UPDATE medications
			SET is_erased = TRUE
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$this->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * Determines whether an experiment exists.
	 * 
	 * It receives the experiment's ID.
	 */
	public function experimentExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM experiments
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Gets a non-erased experiment. If it doesn't exist, null is returned.
	 * 
	 * It receives the experiment's ID.
	 */
	public function getNonErasedExperiment($id) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				creator AS creator,
				last_editor AS lastEditor,
				creation_datetime AS creationDatetime,
				last_edition_datetime AS lastEditionDatetime,
				name AS name,
				command_line AS commandLine
			FROM non_erased_experiments
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return getFirstElementOrNull($results);
	}
	
	/*
	 * Gets a non-erased medication. If it doesn't exist, null is returned.
	 * 
	 * It receives the medication's ID.
	 */
	public function getNonErasedMedication($id) {
		// Defines the statement
		$statement = '
			SELECT
				id AS id,
				creator AS creator,
				last_editor AS lastEditor,
				creation_datetime AS creationDatetime,
				last_edition_datetime AS lastEditionDatetime,
				name AS name
			FROM non_erased_medications
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the first result, or null if there is none
		return getFirstElementOrNull($results);
	}
	
	/*
	 * Determines whether a medication exists.
	 * 
	 * It receives the medication's ID.
	 */
	public function medicationExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM medications
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Determines whether a non-erased experiment exists.
	 * 
	 * It receives the experiment's ID.
	 */
	public function nonErasedExperimentExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM non_erased_experiments
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Determines whether a non-erased medication exists.
	 * 
	 * It receives the medication's ID.
	 */
	public function nonErasedMedicationExists($id) {
		// Defines the statement
		$statement = '
			SELECT 0
			FROM non_erased_medications
			WHERE id = :id
			LIMIT 1
		';
		
		// Sets the parameters
		$parameters = [
			':id' => $id
		];
		
		// Executes the statement
		$results = $this->executePreparedStatement($statement, $parameters);
		
		// Returns the result
		return count($results) === 1;
	}
	
	/*
	 * Connects to the database.
	 * 
	 * It returns a PDO instance representing the connection.
	 */
	protected function connect() {
		$app = $this->app;
		
		// Gets the database's parameters
		$parameters = $app->parameters->get('businessLogicDatabase');
		$dsn = $parameters['dsn'];
		$username = $parameters['username'];
		$password = $parameters['password'];
		
		// Creates and returns the PDO instance
		return new \PDO($dsn, $username, $password);
	}
	
}
