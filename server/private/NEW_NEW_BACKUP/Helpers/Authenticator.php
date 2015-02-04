<?php

namespace App\Helpers;

/*
 * This helpers offers functions to authenticate different entities.
 */
class Authenticator extends \App\Helpers\Helper {
	
	/*
	 * Authenticates a recover password permission by its password and returns
	 * the result.
	 * 
	 * It receives the recover password permission's ID and password.
	 */
	public function authenticateRecoverPasswordPermissionByPassword($id, $password) {
		$app = $this->app;
		
		// Gets the recover password permission
		$recoverPasswordPermission = $app->webServerDatabase->getRecoverPasswordPermission($id);
		
		if (is_null($recoverPasswordPermission)) {
			// The recover password permission doesn't exist
			return false;
		}
		
		// Computes the hash of the password
		$passwordHash = $app->cryptography->hashPassword($password, $recoverPasswordPermission['salt'], $recoverPasswordPermission['keyDerivationIterations']);
		
		// Compares the hash with the stored one and returns the result
		return $passwordHash === $recoverPasswordPermission['passwordHash'];
	}
	
	/*
	 * Authenticates a user by her email address and returns the result.
	 * 
	 * It receives the user's ID and email address.
	 */
	public function authenticateUserByEmailAddress($id, $emailAddress) {
		$app = $this->app;
		
		// Gets the user
		$user = $app->webServerDatabase->getUser($id);
		
		if (is_null($user)) {
			// The user doesn't exist
			return false;
		}
		
		// Compares the email address with the stored one and returns the result
		return $emailAddress === $user['emailAddress'];
	}
	
	/*
	 * Authenticates a user by her password and returns the result.
	 * 
	 * It receives the user's ID and password.
	 */
	public function authenticateUserByPassword($id, $password) {
		$app = $this->app;
		
		// Gets the user
		$user = $app->webServerDatabase->getUser($id);
		
		if (is_null($user)) {
			// The user doesn't exist
			return false;
		}
		
		// Computes the hash of the password
		$passwordHash = $app->cryptography->hashPassword($password, $user['salt'], $user['keyDerivationIterations']);
		
		// Compares the hash with the stored one and returns the result
		return $passwordHash === $user['passwordHash'];
	}
	
}