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

namespace App\Service\LaboratoryTest;

/**
 * Represents the /laboratory-test/edit service.
 */
class Edit extends \App\Service\External {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets inputs
		$id = $this->getInputValue('id', 'hex2bin');
		$version = $this->getInputValue('version');
		$dataTypeDefinition = $this->getInputValue('dataTypeDefinition', 'trimAndShrink');
		$name = $this->getInputValue('name', 'trimAndShrink');
		
		// Gets the signed-in user
		$user = $app->account->getSignedInUser();
		
		// Gets the laboratory test
		$laboratoryTest = $app->data->getRepository('Entity:LaboratoryTest')->findNonDeleted($id);
		
		// Asserts conditions
		$app->assertion->entityExists($laboratoryTest);
		$app->assertion->entityUpdated($laboratoryTest, $version);
		
		// Edits the laboratory test
		$laboratoryTest->setLastEditionDateTime();
		$laboratoryTest->setDataTypeDefinition($dataTypeDefinition);
		$laboratoryTest->setName($name);
		$laboratoryTest->setLastEditor($user);
		$app->data->merge($laboratoryTest);
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
			'id' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
			}),
			
			'version' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isValidInteger($input, 0);
			}),
			
			'dataTypeDefinition' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isDataTypeDefinition($input);
			}),
			
			'name' => new \App\InputValidator\Json\JsonValue(function($input) use ($app) {
				return $app->inputValidator->isValidLine($input, 1, 64);
			})
		]);
		
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
