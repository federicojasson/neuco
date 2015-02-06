<?php

namespace App\Controller\Diagnosis;

use App\Auxiliar\JsonStructureDescriptor\JsonObjectDescriptor;
use App\Auxiliar\JsonStructureDescriptor\JsonValueDescriptor;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/diagnosis/delete
 * Method:	POST
 */
class Delete extends \App\Controller\SpecializedSecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$id = $this->getInput('id', 'hex2bin');
		
		// Checks the existence of the diagnosis
		$this->checkDiagnosisExistence($id);
		
		// Deletes the diagnosis
		$app->data->diagnosis->delete($id);
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
			USER_ROLE_ADMINISTRATOR
		];
		
		// Validates the access and returns the result
		return $app->accessValidator->validateAccess($authorizedUserRoles);
	}
	
	/*
	 * Checks the existence of a diagnosis. If it doesn't exist, the execution
	 * is halted.
	 * 
	 * It receives the diagnosis' ID.
	 */
	private function checkDiagnosisExistence($id) {
		$app = $this->app;
		
		if (! $app->data->diagnosis->exists($id)) {
			// The diagnosis doesn't exist
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_DIAGNOSIS
			]);
		}
	}
	
}
