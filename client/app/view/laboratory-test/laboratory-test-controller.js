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
	angular.module('app.view.laboratoryTest').controller('LaboratoryTestViewController', [
		'$scope',
		'$stateParams',
		'DeleteLaboratoryTestAction',
		'data',
		'router',
		LaboratoryTestViewController
	]);
	
	/**
	 * Represents the laboratory-test view.
	 */
	function LaboratoryTestViewController($scope, $stateParams, DeleteLaboratoryTestAction, data, router) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/laboratory-test/laboratory-test.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return $scope.laboratoryTest.name;
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
			// Gets the URL parameters
			var id = $stateParams.id;
			
			// Resets the data service
			data.reset(1, {
				LaboratoryTest: [
					'creator',
					'lastEditor'
				]
			});
			
			// Gets the laboratory test
			data.getLaboratoryTest(id).then(function(laboratoryTest) {
				// Includes the laboratory test
				$scope.laboratoryTest = laboratoryTest;
				
				// Initializes actions
				initializeDeleteLaboratoryTestAction(laboratoryTest);
				
				ready = true;
			});
		}
		
		/**
		 * Initializes the delete-laboratory-test action.
		 * 
		 * Receives the laboratory test.
		 */
		function initializeDeleteLaboratoryTestAction(laboratoryTest) {
			// Initializes the action
			var action = new DeleteLaboratoryTestAction();
			
			// Sets inputs' initial values
			action.input.id.value = laboratoryTest.id;
			action.input.version.value = laboratoryTest.version;
			
			// Registers callbacks
			
			action.startCallback = function() {
				ready = false;
			};
			
			action.successCallback = function() {
				// Redirects the user to the laboratory-tests state
				router.redirect('laboratoryTests');
			};
			
			// Includes the action
			$scope.deleteLaboratoryTestAction = action;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
