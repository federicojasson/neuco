/**
 * NEU-CO - Neuro-Cognitivo
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
	angular.module('app.action.editImagingTest').factory('EditImagingTestAction', [
		'inputValidator',
		'Input',
		'server',
		EditImagingTestActionFactory
	]);
	
	/**
	 * Defines the EditImagingTestAction class.
	 */
	function EditImagingTestActionFactory(inputValidator, Input, server) {
		/**
		 * The input.
		 */
		EditImagingTestAction.prototype.input;
		
		/**
		 * The start callback.
		 */
		EditImagingTestAction.prototype.startCallback;
		
		/**
		 * The success callback.
		 */
		EditImagingTestAction.prototype.successCallback;
		
		/**
		 * Initializes an instance of the class.
		 */
		function EditImagingTestAction() {
			this.startCallback = new Function();
			this.successCallback = new Function();
			
			// Initializes the input
			this.input = {
				id: new Input(),
				version: new Input(),
				
				dataTypeDefinition: new Input(function() {
					return inputValidator.isDataTypeDefinition(this);
				}),
				
				name: new Input(function() {
					return inputValidator.isValidString(this, 1, 64);
				})
			};
		}
		
		/**
		 * Executes the action.
		 */
		EditImagingTestAction.prototype.execute = function() {
			if (! inputValidator.isInputValid(this.input)) {
				// The input is invalid
				return;
			}
			
			// Invokes the start callback
			this.startCallback();
			
			// Edits the imaging test
			server.imagingTest.edit({
				id: this.input.id.value,
				version: this.input.version.value,
				dataTypeDefinition: this.input.dataTypeDefinition.value,
				name: this.input.name.value
			}).then(function() {
				// Invokes the success callback
				this.successCallback();
			}.bind(this));
		};
		
		// ---------------------------------------------------------------------
		
		return EditImagingTestAction;
	}
})();
