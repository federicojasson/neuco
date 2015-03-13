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
	angular.module('app.view.newMedicine').controller('NewMedicineViewController', [
		'$scope',
		'CreateMedicineAction',
		'router',
		NewMedicineViewController
	]);
	
	/**
	 * Represents the new-medicine view.
	 */
	function NewMedicineViewController($scope, CreateMedicineAction, router) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready, considering the local factors.
		 * 
		 * Since it considers only the local factors, it doesn't necessarily
		 * determine on its own whether the view is ready.
		 */
		var ready = true;
		
		/**
		 * Returns the URL of the template.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/new-medicine/new-medicine.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return 'Nuevo medicamento';
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
			// Initializes the create-medicine action
			var createMedicineAction = new CreateMedicineAction();
			createMedicineAction.startCallback = onStart;
			createMedicineAction.successCallback = onSuccess;
			
			// Includes the actions
			$scope.action = {
				createMedicine: createMedicineAction
			};
		}
		
		/**
		 * Invoked at the start of the create-medicine action.
		 */
		function onStart() {
			ready = false;
		}
		
		/**
		 * Invoked when the create-medicine action is successful.
		 * 
		 * Receives the created medicine's ID.
		 */
		function onSuccess(id) {
			// Redirects the user to the medicine route
			router.redirect('/medicine/' + id);
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the view
		initialize();
	}
})();