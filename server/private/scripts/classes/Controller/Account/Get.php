<?php

namespace App\Controller\Account;

/*
 * This controller is responsible for the following service:
 * 
 * URI:		/server/account/get
 * Method:	POST
 */
class Get extends \App\Controller\SpecializedExternalController {
	
	/*
	 * Calls the controller.
	 */
	protected function call() {
		$app = $this->app;
		
		// Gets the signed in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Gets the user
		$user = $this->getUser($signedInUser['id']);
		
		// Filters the user
		$user = $app->data->user->filter($user);
		
		// Sets the output
		$this->setEntireOutput($user);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		// The service has no input
		return true;
	}
	
	/*
	 * Determines whether the user is authorized to use the service.
	 */
	protected function isUserAuthorized() {
		$app = $this->app;
		
		// The service is available only to signed in users
		return $app->authentication->isUserSignedIn();
	}
	
}
