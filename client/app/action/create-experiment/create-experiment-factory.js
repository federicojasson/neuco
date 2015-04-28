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
	angular.module('app.action.createExperiment').factory('CreateExperimentAction', [
		'inputValidator',
		'Input',
		'server',
		CreateExperimentActionFactory
	]);
	
	/**
	 * Defines the CreateExperimentAction class.
	 */
	function CreateExperimentActionFactory(inputValidator, Input, server) {
		/**
		 * The input.
		 */
		CreateExperimentAction.prototype.input;
		
		/**
		 * The not-authenticated callback.
		 */
		CreateExperimentAction.prototype.notAuthenticatedCallback;
		
		/**
		 * The start callback.
		 */
		CreateExperimentAction.prototype.startCallback;
		
		/**
		 * The success callback.
		 */
		CreateExperimentAction.prototype.successCallback;
		
		/**
		 * Initializes an instance of the class.
		 */
		function CreateExperimentAction() {
			this.startCallback = new Function();
			this.notAuthenticatedCallback = new Function();
			this.successCallback = new Function();
			
			// Initializes the input
			this.input = {
				// TODO
			};
		}
		
		/**
		 * Executes the action.
		 */
		CreateExperimentAction.prototype.execute = function() {
			if (! inputValidator.isInputValid(this.input)) {
				// The input is invalid
				return;
			}
			
			// Invokes the start callback
			this.startCallback();
			
			// Creates the experiment
			server.experiment.create({
				// TODO
			}).then(function(output) {
				if (! output.authenticated) {
					// The user has not been authenticated
					
					// Invokes the not-authenticated callback
					this.notAuthenticatedCallback();
					
					return;
				}
				
				// Invokes the success callback
				this.successCallback(output.id);
			}.bind(this));
		};
		
		// ---------------------------------------------------------------------
		
		return CreateExperimentAction;
	}
})();