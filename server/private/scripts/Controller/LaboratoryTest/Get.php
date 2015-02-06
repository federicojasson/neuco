<?php

namespace App\Controller\LaboratoryTest;

use App\Auxiliar\JsonStructureDescriptor\JsonObjectDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonValueDescriptor;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/laboratory-test/get
 * Method:	POST
 */
class Get extends \App\Controller\SpecializedSecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$id = $this->getInput('id', 'hex2bin');
		
		// Gets the laboratory test
		$laboratoryTest = $this->getLaboratoryTest($id);
		
		// Filters the laboratory test
		$laboratoryTest = $app->data->laboratoryTest->filter($laboratoryTest);
		
		// Sets the output
		$this->setOutputCompletely($laboratoryTest);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the JSON structure descriptor
		$jsonStructureDescriptor = new JsonObjectDescriptor([
			'id' => new JsonValueDescriptor(function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
			})
		]);
		
		// Validates the JSON request and returns the result
		return $this->validateJsonRequest($jsonStructureDescriptor);
	}
	
	/*
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_DOCTOR
		];
		
		// Validates the access and returns the result
		return $app->accessValidator->validateAccess($authorizedUserRoles);
	}
	
	/*
	 * Returns a laboratory test. If it doesn't exist, the execution is halted.
	 * 
	 * It receives the laboratory test's ID.
	 */
	private function getLaboratoryTest($id) {
		$app = $this->app;
		
		// Gets the laboratory test
		$laboratoryTest = $app->data->laboratoryTest->get($id);
		
		if (is_null($laboratoryTest)) {
			// The laboratory test doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_LABORATORY_TEST
			]);
		}
		
		return $laboratoryTest;
	}
	
}
