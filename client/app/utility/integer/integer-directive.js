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
	angular.module('app.utility.integer').directive('integer', [
		'utility',
		integerDirective
	]);
	
	/**
	 * Processes an input and converts its values to integer.
	 */
	function integerDirective(utility) {
		/**
		 * Returns the settings.
		 */
		function getSettings() {
			return {
				require: 'ngModel',
				restrict: 'A',
				link: onLink
			};
		}
		
		/**
		 * Invoked after the linking phase.
		 * 
		 * Receives the scope of the directive, the element matched by it, its
		 * attributes and the ng-model controller.
		 */
		function onLink(scope, element, attributes, ngModelController) {
			// Registers a parser
			ngModelController.$parsers.push(function(value) {
				// Converts the value from string to integer
				var newValue = utility.stringToInteger(value);
				
				if (isNaN(newValue)) {
					// The value is not a number
					return value;
				}
				
				return newValue;
			});
		}
		
		// ---------------------------------------------------------------------
		
		// Gets the settings
		return getSettings();
	}
})();
