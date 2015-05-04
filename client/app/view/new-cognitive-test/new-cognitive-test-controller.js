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
	angular.module('app.view.newCognitiveTest').controller('NewCognitiveTestViewController', [
		'$scope',
		'CreateCognitiveTestAction',
		'router',
		NewCognitiveTestViewController
	]);
	
	/**
	 * Represents the new-cognitive-test view.
	 */
	function NewCognitiveTestViewController($scope, CreateCognitiveTestAction, router) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = true;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/new-cognitive-test/new-cognitive-test.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return 'Nuevo examen cognitivo';
		};
		
		/**
		 * Determines whether the view is ready.
		 */
		_this.isReady = function() {
			return ready;
		};
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Initializes actions
			initializeCreateCognitiveTestAction();
		}
		
		/**
		 * Initializes the create-cognitive-test action.
		 */
		function initializeCreateCognitiveTestAction() {
			// Initializes the action
			var action = new CreateCognitiveTestAction();
			
			// Registers callbacks
			
			action.startCallback = function() {
				ready = false;
			};
			
			action.successCallback = function(id) {
				// Redirects the user to the cognitive-test state
				router.redirect('cognitiveTest', {
					id: id
				});
			};
			
			// Includes the action
			$scope.createCognitiveTestAction = action;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
