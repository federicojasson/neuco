/**
 * ETRS - Eye Tracking Record System
 * Copyright (C) 2015 Federico Jasson
 * 
 * The JavaScript code in this page is free software: you can redistribute it
 * and/or modify it under the terms of the GNU General Public License (GNU GPL)
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version. The code is distributed
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU GPL for more details.
 * 
 * As additional permission under GNU GPL version 3 section 7, you may
 * distribute non-source (e.g., minimized or compacted) forms of that code
 * without the copy of the GNU GPL normally required by section 4, provided you
 * include this license notice and a URL through which recipients can access the
 * Corresponding Source.
 */

'use strict';

(function() {
	angular.module('app.action.requestSignUp').factory('RequestSignUpAction', [
		'inputValidator',
		'Input',
		'server',
		RequestSignUpActionFactory
	]);
	
	/**
	 * Defines the RequestSignUpAction class.
	 */
	function RequestSignUpActionFactory(inputValidator, Input, server) {
		/**
		 * The input.
		 */
		RequestSignUpAction.prototype.input;
		
		/**
		 * The not-authenticated callback.
		 */
		RequestSignUpAction.prototype.notAuthenticatedCallback;
		
		/**
		 * The start callback.
		 */
		RequestSignUpAction.prototype.startCallback;
		
		/**
		 * The success callback.
		 */
		RequestSignUpAction.prototype.successCallback;
		
		/**
		 * Initializes an instance of the class.
		 */
		function RequestSignUpAction() {
			this.notAuthenticatedCallback = function() {};
			this.startCallback = function() {};
			this.successCallback = function() {};
			
			// Initializes the input
			this.input = {
				credentials: {
					password: new Input(function() {
						return inputValidator.isValidString(this, 1);
					})
				},
				
				recipient: {
					fullName: new Input(function() {
						return inputValidator.isValidString(this, 0, 97);
					}),
					
					emailAddress: new Input(function() {
						// TODO
					})
				},
				
				userRole: new Input(function() {
					// TODO
				})
			};
		}
		
		/**
		 * Executes the action.
		 */
		RequestSignUpAction.prototype.execute = function() {
			if (! inputValidator.isInputValid(this.input)) {
				// The input is invalid
				return;
			}
			
			// TODO: confirmation dialog
			
			// Invokes the start callback
			this.startCallback();
			
			// Requests the sign up
			server.permission.signUp.request({
				credentials: {
					password: this.input.credentials.password.value
				},
				
				recipient: {
					fullName: this.input.recipient.fullName.value,
					emailAddress: this.input.recipient.emailAddress.value
				},
				
				userRole: this.input.userRole.value
			}).then(function(output) {
				if (! output.authenticated) {
					// The user has not been authenticated
					
					// Invokes the not-authenticated callback
					this.notAuthenticatedCallback();
					
					return;
				}
				
				// Invokes the success callback
				this.successCallback();
			}.bind(this));
		};
		
		// ---------------------------------------------------------------------
		
		return RequestSignUpAction;
	}
})();
