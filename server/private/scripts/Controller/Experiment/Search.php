<?php

namespace App\Controller\Experiment;

/*
 * This controller is responsible for the following service:
 * 
 * URL:		/server/experiment/search
 * Method:	POST
 */
class Search extends \App\Controller\SpecializedSecureController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the input
		$expression = $this->getInput('expression');
		$page = $this->getInput('page');
		$sorting = $this->getInput('sorting');
		
		// Searches the experiments
		list($total, $results) = $app->data->experiment->search($expression, $page, $sorting);
		
		// Sets the output
		$this->setEntireOutput([
			'total' => $total,
			'results' => $results
		]);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		// Gets the JSON structure descriptor
		$jsonStructureDescriptor = $this->getSearchJsonStructureDescriptor([
			'creationDatetime',
			'lastEditionDatetime',
			'name'
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
			USER_ROLE_OPERATOR
		];
		
		// Validates the access and returns the result
		return $app->accessValidator->validateAccess($authorizedUserRoles);
	}
	
}