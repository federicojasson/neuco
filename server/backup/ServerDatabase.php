<?php

/*
 * This class offers services to interact with the server database.
 */
class ServerDatabase {
	
	/*
	 * Represents the connection with the DBMS.
	 */
	private $dbmsConnection;
	
	/*
	 * TODO
	 */
	public function connect($userName, $password) {
		$dsn = SERVER_DATABASE_DSN;
		$userName = 'etrs_system';
		$password = 'password'; // TODO
		
		// Creates a connection with the DBMS
		$this->dbmsConnection = new DbmsConnection($dsn, $userName, $password);
	}
	
	/*
	 * TODO
	 */
	public function deleteExpiredSessions($lifetime) {
		$statement = '
			CALL delete_expired_sessions (
				:lifetime
			)
		';
		
		$parameters = [
			':lifetime' => $lifetime
		];
		
		$this->dbmsConnection->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * TODO
	 */
	public function deleteSession($id) {
		$statement = '
			CALL delete_session (
				:id
			)
		';
		
		$parameters = [
			':id' => $id
		];
		
		$this->dbmsConnection->executePreparedStatement($statement, $parameters);
	}
	
	/*
	 * TODO
	 */
	public function getSessionData($id) {
		$statement = '
			SELECT data
			FROM sessions
			WHERE id LIKE BINARY :id
			LIMIT 1
		';
		
		$parameters = [
			':id' => $id
		];
		
		$rows = $this->dbmsConnection->executePreparedStatement($statement, $parameters);
		
		if (count($rows) === 0)
			return null;
		
		return new SessionData($rows[0]);
	}
	
	/*
	 * TODO
	 */
	public function insertOrUpdateSession($id, $data) {
		$statement = '
			CALL insert_or_update_session (
				:id,
				:data
			)
		';
		
		$parameters = [
			':id' => $id,
			':data' => $data
		];
		
		$this->dbmsConnection->executePreparedStatement($statement, $parameters);
	}
	
}