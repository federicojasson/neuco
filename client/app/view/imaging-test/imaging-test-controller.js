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
	angular.module('app.view.imagingTest').controller('ImagingTestViewController', [
		'$scope',
		'$stateParams',
		'DeleteImagingTestAction',
		'data',
		'router',
		ImagingTestViewController
	]);
	
	/**
	 * Represents the imaging-test view.
	 */
	function ImagingTestViewController($scope, $stateParams, DeleteImagingTestAction, data, router) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/imaging-test/imaging-test.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return $scope.imagingTest.name;
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
				ImagingTest: [
					'creator',
					'lastEditor'
				]
			});
			
			// Gets the imaging test
			data.getImagingTest(id).then(function(imagingTest) {
				// Includes the imaging test
				$scope.imagingTest = imagingTest;
				
				// Initializes actions
				initializeDeleteImagingTestAction(imagingTest);
				
				ready = true;
			});
		}
		
		/**
		 * Initializes the delete-imaging-test action.
		 * 
		 * Receives the imaging test.
		 */
		function initializeDeleteImagingTestAction(imagingTest) {
			// Initializes the action
			var action = new DeleteImagingTestAction();
			
			// Sets inputs' initial values
			action.input.id.value = imagingTest.id;
			action.input.version.value = imagingTest.version;
			
			// Registers callbacks
			
			action.startCallback = function() {
				ready = false;
			};
			
			action.successCallback = function() {
				// Redirects the user to the imaging-tests state
				router.redirect('imagingTests');
			};
			
			// Includes the action
			$scope.deleteImagingTestAction = action;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
