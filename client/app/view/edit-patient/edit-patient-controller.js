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
	angular.module('app.view.editPatient').controller('EditPatientViewController', [
		'$scope',
		'$stateParams',
		'EditPatientAction',
		'data',
		'router',
		'fullNameFilter',
		EditPatientViewController
	]);
	
	/**
	 * Represents the edit-patient view.
	 */
	function EditPatientViewController($scope, $stateParams, EditPatientAction, data, router, fullNameFilter) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/edit-patient/edit-patient.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return fullNameFilter($scope.patient);
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
			data.reset();
			
			// Gets the patient
			data.getPatient(id).then(function(patient) {
				// Includes the patient
				$scope.patient = patient;
				
				// Initializes actions
				initializeEditPatientAction(patient);
				
				ready = true;
			});
		}
		
		/**
		 * Initializes the edit-patient action.
		 * 
		 * Receives the patient.
		 */
		function initializeEditPatientAction(patient) {
			// Initializes the action
			var action = new EditPatientAction();
			
			// Sets inputs' initial values
			action.input.id.value = patient.id;
			action.input.version.value = patient.version;
			action.input.firstName.value = patient.firstName;
			action.input.lastName.value = patient.lastName;
			action.input.gender.value = patient.gender;
			action.input.birthDate.value = patient.birthDate;
			action.input.yearsOfEducation.value = patient.yearsOfEducation;
			
			// Registers callbacks
			
			action.startCallback = function() {
				ready = false;
			};
			
			action.successCallback = function() {
				// Redirects the user to the patient state
				router.redirect('patient', {
					id: patient.id
				});
			};
			
			// Includes the action
			$scope.editPatientAction = action;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
