<?php

/*
 * This class is used to write logs in a database.
 */
class DatabaseLogWriter {
	
	/*
	 * The cryptography helper.
	 */
	private $cryptography;
	
	/*
	 * The database helper through which the logs are written.
	 */
	private $database;
	
	/*
	 * Creates an instance of this class.
	 * 
	 * It receives the cryptography and database helpers.
	 */
	public function __construct($cryptography, $database) {
		$this->cryptography = $cryptography;
		$this->database = $database;
	}
	
	/*
	 * Writes a log in the database.
	 * 
	 * It receives the message and the level.
	 */
	public function write($message, $level) {
		$database = $this->database;
		
		// Generate a random ID
		do {
			$id = $this->cryptography->generateRandomId();
		} while ($database->logExists($id));
		
		// Gets the type of the log
		$type = getLogType($level);
		
		// Inserts the log
		$database->insertLog($id, $type, $message);
	}
	
	/*
	 * Returns the type of a log, according to its level.
	 * 
	 * It receives the level.
	 */
	private function getLogType($level) {
		switch ($level) {
			case Log::EMERGENCY: {
				return 'EM';
			}
			
			case Log::ALERT: {
				return 'AL';
			}
			
			case Log::CRITICAL: {
				return 'CR';
			}
			
			case Log::ERROR: {
				return 'ER';
			}
			
			case Log::WARN: {
				return 'WA';
			}
			
			case Log::NOTICE: {
				return 'NO';
			}
			
			case Log::INFO: {
				return 'IN';
			}
			
			case Log::DEBUG: {
				return 'DE';
			}
		}
	}
	
}
