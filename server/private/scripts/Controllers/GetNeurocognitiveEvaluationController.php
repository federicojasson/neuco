<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-neurocognitive-evaluation
 *	Method:	POST
 */
class GetNeurocognitiveEvaluationController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		
		// Gets the neurocognitive evaluation's ID
		$neurocognitiveEvaluationId = hexadecimalToBinary($input['id']);
		
		// Gets the neurocognitive evaluation
		$neurocognitiveEvaluation = $app->data->getNeurocognitiveEvaluation($neurocognitiveEvaluationId);
		
		if (is_null($neurocognitiveEvaluation)) {
			// The neurocognitive evaluation doesn't exist
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'id' => ERROR_ID_NON_EXISTENT_NEUROCOGNITIVE_EVALUATION
			]);
		}
		
		// Filters the neurocognitive evaluation
		$filteredNeurocognitiveEvaluation = $app->dataFilter->filterNeurocognitiveEvaluation($neurocognitiveEvaluation);
		
		// Sets the output
		$app->response->setBody($filteredNeurocognitiveEvaluation);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		$app = $this->app;
		$inputValidator = $app->inputValidator;
		
		// Defines the expected JSON structure
		$jsonStructureDescriptor = new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_OBJECT, [
			'id' => new JsonStructureDescriptor(JSON_STRUCTURE_TYPE_VALUE, function($jsonValue) use ($inputValidator) {
				return $inputValidator->isValidRandomId($jsonValue);
			})
		]);
		
		// Validates the request and returns the result
		return $inputValidator->validateJsonRequest($app->request, $jsonStructureDescriptor);
	}
	
	/*
	 * Determines whether the user is authorized to use this service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// Defines the authorized user roles
		$authorizedUserRoles = [
			// TODO: define authorized user roles
		];
		
		// Validates the authentication and returns the result
		return $app->authorizationValidator->validateAuthentication($app->authentication, $authorizedUserRoles);
	}

}
