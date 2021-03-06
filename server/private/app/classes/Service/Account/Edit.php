<?php

/**
 * NEU-CO - Neuro-Cognitivo
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

namespace App\Service\Account;

/**
 * Represents the /account/edit service.
 */
class Edit extends \App\Service\External {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets inputs
		$credentials = $this->getInputValue('credentials');
		$emailAddress = $this->getInputValue('emailAddress');
		$firstName = $this->getInputValue('firstName', 'trimAndShrink');
		$lastName = $this->getInputValue('lastName', 'trimAndShrink');
		$gender = $this->getInputValue('gender');
		
		// Gets the signed-in user
		$user = $app->account->getSignedInUser();
		
		// Authenticates the user
		$authenticated = $app->authenticator->authenticateUserByPassword($user->getId(), $credentials['password']);
		
		// Sets an output
		$this->setOutputValue('authenticated', $authenticated);
		
		if (! $authenticated) {
			// The user has not been authenticated
			return;
		}
		
		// Edits the user
		$user->setLastEditionDateTime();
		$user->setEmailAddress($emailAddress);
		$user->setFirstName($firstName);
		$user->setLastName($lastName);
		$user->setGender($gender);
		$app->data->merge($user);
	}
	
	/**
	 * Determines whether the request is valid.
	 */
	protected function isRequestValid() {
		global $app;
		
		if (! $this->isJsonRequest()) {
			// It is not a JSON request
			return false;
		}
		
		// Gets the input
		$input = $this->getInput();
		
		// Builds an input validator
		$inputValidator = new \App\InputValidator\Input\InputObject([
			'credentials' => new \App\InputValidator\Input\InputObject([
				'password' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
					return $app->inputValidator->isValidString($input, 1);
				})
			]),
			
			'emailAddress' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
				return $app->inputValidator->isEmailAddress($input);
			}),
			
			'firstName' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
				return $app->inputValidator->isValidLine($input, 1, 48);
			}),
			
			'lastName' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
				return $app->inputValidator->isValidLine($input, 1, 48);
			}),
			
			'gender' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
				return $app->inputValidator->isGender($input);
			})
		]);
		
		// Validates the input
		return $app->inputValidator->isInputValid($input, $inputValidator);
	}
	
	/**
	 * Determines whether the user is authorized.
	 */
	protected function isUserAuthorized() {
		global $app;
		
		// Only signed-in users are authorized
		return $app->account->isUserSignedIn();
	}

}
