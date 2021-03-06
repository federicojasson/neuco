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
	angular.module('app.layout.error').controller('ErrorLayoutController', [
		'$controller',
		'$scope',
		'error',
		ErrorLayoutController
	]);
	
	/**
	 * Represents the error layout.
	 */
	function ErrorLayoutController($controller, $scope, error) {
		var _this = this;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/layout/error/error.html';
		};
		
		/**
		 * Returns the title to be set when the layout is ready.
		 */
		_this.getTitle = function() {
			return error.get().message;
		};
		
		/**
		 * Determines whether the layout is ready.
		 */
		_this.isReady = function() {
			return true;
		};
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Includes controllers
			$scope.error = $controller('ErrorController');
			$scope.router = $controller('RouterController');
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
