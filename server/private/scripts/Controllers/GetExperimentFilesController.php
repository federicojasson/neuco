<?php

/*
 * This controller is responsible for the following service:
 * 
 *	URL:	/server/get-experiment-files
 *	Method:	POST
 */
class GetExperimentFilesController extends SecureController {
	
	/*
	 * Executes the controller.
	 */
	protected function execute() {
		$app = $this->app;
		
		// Gets the input
		$input = $app->request->getBody();
		
		// Gets the experiment ID
		$experimentId = $input['id'];
		
		// Gets the experiment
		$experiment = $app->data->getExperiment($experimentId, ['files']);
		
		// Sets the output
		$app->response->setBody($experiment['files']);
	}
	
	/*
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		// TODO: implement
	}
	
	/*
	 * Determines whether the user is authorized to use this service.
	 */
	protected function isUserAuthorized() {
		// TODO: implement
	}

}
