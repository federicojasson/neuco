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
	angular.module('app.inputValidator').service('inputValidator', inputValidatorService);
	
	/**
	 * Provides input-validation functions.
	 */
	function inputValidatorService() {
		var _this = this;
		
		/**
		 * Determines whether an input is valid.
		 * 
		 * Receives the input, which can be an Input instance or an object. In
		 * the latter case, the object's properties are validated recursively.
		 */
		_this.isInputValid = function(input) {
			if (angular.isDefined(input.validate) && angular.isFunction(input.validate)) {
				// The input is an Input instance
				
				// Validates the input
				input.validate();
				
				// Determines whether the input is valid
				return input.valid;
			}
			
			// Validates the object's properties
			var valid = true;
			for (var property in input) {
				if (! input.hasOwnProperty(property)) {
					continue;
				}
				
				// Validates the property
				valid &= _this.isInputValid(input[property]);
			}
			
			return valid;
		};
		
		/**
		 * Determines whether an input is a valid string.
		 * 
		 * Receives the input, the minimum allowed length and, optionally, the
		 * maximum.
		 */
		_this.isValidString = function(input, minimumLength, maximumLength) {
			// Gets the input's length
			var length = input.value.length;
			
			// Initializes the maximum length if is undefined
			maximumLength = (angular.isDefined(maximumLength))? maximumLength : length;
			
			if (length < minimumLength) {
				// The input is too short
				input.message = '';
				input.message += 'Este campo debe tener al menos ' + minimumLength + ' ';
				input.message += (minimumLength === 1)? 'caracter' : 'caracteres';
				return false;
			}
			
			if (length > maximumLength) {
				// The input is too long
				input.message = '';
				input.message += 'Este campo puede tener a lo sumo ' + maximumLength + ' ';
				input.message += (maximumLength === 1)? 'caracter' : 'caracteres';
				return false;
			}
			
			// The input is a valid string
			input.message = '';
			return true;
		};
	}
})();