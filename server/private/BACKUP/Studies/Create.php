<?php

namespace App\Controllers\Studies;

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/studies/create
 *	Method:	POST
 */
class Create extends \App\Controllers\SecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		$consultation = hex2bin($input['consultation']);
		$experiment = hex2bin($input['experiment']);
		$report = (is_null($input['report']))? null : hex2bin($input['report']);
		$observations = $input['observations']; // TODO: trim?
		
		// Starts a read-write transaction
		$app->businessLogicDatabase->startReadWriteTransaction();
		
		if (! $app->businessLogicDatabase->nonErasedConsultationExists($consultation)) {
			// The consultation doesn't exist
			
			// Rolls back the transaction
			$app->businessLogicDatabase->rollBackTransaction();
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_CONSULTATION
			]);
		}
		
		if (! $app->businessLogicDatabase->nonErasedExperimentExists($experiment)) {
			// The experiment doesn't exist
			
			// Rolls back the transaction
			$app->businessLogicDatabase->rollBackTransaction();
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_EXPERIMENT
			]);
		}
		
		// TODO: how to handle files?
		if (! is_null($report)) {
			if (! $app->businessLogicDatabase->nonErasedFileExists($report)) { // TODO: implement
				// The file doesn't exist

				// Rolls back the transaction
				$app->businessLogicDatabase->rollBackTransaction();

				// Halts the execution
				$app->halt(HTTP_STATUS_NOT_FOUND, [
					'error' => ERROR_NON_EXISTENT_FILE
				]);
			}
		}
		
		do {
			// Generates a random ID
			$id = $app->cryptography->generateRandomId();
		} while ($app->businessLogicDatabase->studyExists($id));
		
		// Gets the signed in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Creates the study
		$app->businessLogicDatabase->createStudy($id, $consultation, $signedInUser['id'], $experiment, $signedInUser['id'], $report, $observations);
		
		// Commits the transaction
		$app->businessLogicDatabase->commitTransaction();
		
		// TODO: how to handle automatic report creation?
		
		// Sets the output
		$app->response->setBody([
			'id' => bin2hex($id)
		]);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
			'consultation' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
			}),
			
			'experiment' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				return $app->inputValidator->isRandomId($input);
			}),
			
			'report' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				if (is_null($input)) {
					return true;
				}
				
				return $app->inputValidator->isRandomId($input);
			}),
			
			'observations' => new \App\Auxiliars\JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($input) use ($app) {
				// TODO: implement
				return true;
			})
		]);
		
		// Validates the request and returns the result
		return $app->inputValidator->validateJsonRequest($jsonStructureDescriptor);
	}
	
	/*
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			// TODO: define user roles
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($authorizedUserRoles);
	}
	
}