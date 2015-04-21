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

namespace App\Service\Experiment;

/**
 * Represents the /experiment/create service.
 */
class Create extends \App\Service\External {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets inputs
		$commandLine = $this->getInputValue('commandLine'); // TODO: filter?
		$name = $this->getInputValue('name', 'trimAndShrink');
		$files = $this->getInputValue('files', createArrayFilter('hex2bin'));
		
		// Gets the signed-in user
		$user = $app->account->getSignedInUser();
		
		// Creates the experiment
		$experiment = new \App\Data\Entity\Experiment();
		$experiment->setCommandLine($commandLine);
		$experiment->setName($name);
		$experiment->setCreator($user);
		$app->data->persist($experiment);
		
		// Gets the experiment's ID
		$id = $experiment->getId();
		
		// Sets an output
		$this->setOutputValue('id', $id, 'bin2hex');
		
		// TODO: check existence and add associations
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
		
		// Builds a JSON input validator
		$jsonInputValidator = new \App\InputValidator\Json\JsonObject([
			'commandLine' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				// TODO
			}),
			
			'name' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isValidLine($input, 1, 64);
			}),
			
			'files' => new \App\InputValidator\Json\JsonArray(
				new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
					return $app->inputValidator->isRandomId($input);
				})
			)
		]);
		
		// TODO: check duplicates on files
		
		// Validates the input
		return $app->inputValidator->isJsonInputValid($input, $jsonInputValidator);
	}
	
	/**
	 * Determines whether the user is authorized.
	 */
	protected function isUserAuthorized() {
		global $app;
		
		// Validates the access
		return $app->accessValidator->isUserAuthorized([
			USER_ROLE_ADMINISTRATOR
		]);
	}

}