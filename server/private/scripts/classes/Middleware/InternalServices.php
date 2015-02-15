<?php

namespace App\Middleware;

/*
 * This middleware defines the internal services.
 */
class InternalServices extends \Slim\Middleware {

	/*
	 * Calls the middleware.
	 */
	public function call() {
		// Defines the internal services
		$this->defineInternalServices();

		// Calls the next middleware
		$this->next->call();
	}

	/*
	 * Defines the internal services.
	 */
	private function defineInternalServices() {
		$app = $this->app;

		// Defines the internal services

		// TODO: method?
		// URI:		/server/log/delete-old
		// Method:	POST
		$app->services->define(
			'/log/delete-old',
			'POST',
			new \App\Controller\Log\DeleteOld()
		);

		// TODO: method?
		// URI:		/server/recover-password-permission/delete-old
		// Method:	POST
		$app->services->define(
			'/recover-password-permission/delete-old',
			'POST',
			new \App\Controller\RecoverPasswordPermission\DeleteOld()
		);

		// TODO: method?
		// URI:		/server/sandbox/process
		// Method:	POST
		$app->services->define(
			'/sandbox/process',
			'POST',
			new \App\Controller\Sandbox\Process()
		);

		// TODO: method?
		// URI:		/server/session/delete-inactive
		// Method:	POST
		$app->services->define(
			'/session/delete-inactive',
			'POST',
			new \App\Controller\Session\DeleteInactive()
		);

		// TODO: method?
		// URI:		/server/sign-up-permission/delete-old
		// Method:	POST
		$app->services->define(
			'/sign-up-permission/delete-old',
			'POST',
			new \App\Controller\SignUpPermission\DeleteOld()
		);
	}

}
