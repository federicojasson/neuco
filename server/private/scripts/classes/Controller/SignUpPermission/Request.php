<?php

namespace App\Controller\SignUpPermission;

use App\Auxiliar\JsonStructureDescriptor\JsonObjectDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonValueDescriptor;

/*
 * This controller is responsible for the following service:
 * 
 * URI:		/server/sign-up-permission/request
 * Method:	POST
 */
class Request extends \App\Controller\SpecializedExternalController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$credentials = $this->getInput('credentials');
		$recipient = $this->getInput('recipient');
		$role = $this->getInput('role');
		
		// Gets the signed in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Authenticates the user
		$authenticated = $app->authenticator->authenticateUserByPassword($signedInUser['id'], $credentials['password']);
		
		// Sets an output
		$this->setOutput('authenticated', $authenticated);
		
		if (! $authenticated) {
			// The user was not authenticated
			return;
		}
		
		// Generates a random ID
		$id = $app->cryptography->generateRandomId();
		
		// Generates a random password
		$password = $app->cryptography->generateRandomPassword();
		
		// Computes the hash of the password
		list($passwordHash, $salt, $keyStretchingIterations) = $app->cryptography->hashNewPassword($password);
		
		// Creates the sign up permission
		$app->data->signUpPermission->create($id, $signedInUser['id'], $passwordHash, $salt, $keyStretchingIterations, $role);
		
		// Sends a sign up email
		$app->emails->sendSignUpEmail($recipient, $id, $password);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the JSON structure descriptor
		$jsonStructureDescriptor = new JsonObjectDescriptor([
			'credentials' => new JsonObjectDescriptor([
				'password' => new JsonValueDescriptor(function($input) use ($app) {
					return $app->inputValidator->isValidString($input, 1);
				})
			]),
			
			'recipient' => new JsonObjectDescriptor([
				'name' => new JsonValueDescriptor(function($input) use ($app) {
					return $app->inputValidator->isValidString($input, 0);
				}),
				
				'emailAddress' => new JsonValueDescriptor(function($input) use ($app) {
					return $app->inputValidator->isEmailAddress($input);
				})
			]),
			
			'role' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isUserRole($input);
			})
		]);
		
		// Validates the JSON input and returns the result
		return $this->validateJsonInput($jsonStructureDescriptor);
	}
	
	/*
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			USER_ROLE_ADMINISTRATOR
		];
		
		// Validates the access and returns the result
		return $app->accessValidator->validateAccess($authorizedUserRoles);
	}
	
}