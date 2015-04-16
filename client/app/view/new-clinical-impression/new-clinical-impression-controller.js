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
	angular.module('app.view.newClinicalImpression').controller('NewClinicalImpressionViewController', [
		'$scope',
		'CreateClinicalImpressionAction',
		'router',
		NewClinicalImpressionViewController
	]);
	
	/**
	 * Represents the new-clinical-impression view.
	 */
	function NewClinicalImpressionViewController($scope, CreateClinicalImpressionAction, router) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = true;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/new-clinical-impression/new-clinical-impression.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return 'Nueva impresión clínica';
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
			// Initializes the actions
			initializeCreateClinicalImpressionAction();
		}
		
		/**
		 * Initializes the create-clinical-impression action.
		 */
		function initializeCreateClinicalImpressionAction() {
			// Initializes the action
			var action = new CreateClinicalImpressionAction();
			
			// Registers the callbacks
			
			action.startCallback = function() {
				ready = false;
			};
			
			action.successCallback = function(id) {
				// Redirects the user to the clinical-impression state
				router.redirect('clinicalImpression', {
					id: id
				});
			};
			
			// Includes the action
			$scope.createClinicalImpressionAction = action;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();