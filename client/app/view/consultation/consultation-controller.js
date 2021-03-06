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
	angular.module('app.view.consultation').controller('ConsultationViewController', [
		'$controller',
		'$filter',
		'$scope',
		'$stateParams',
		'DeleteConsultationAction',
		'data',
		'router',
		ConsultationViewController
	]);
	
	/**
	 * Represents the consultation view.
	 */
	function ConsultationViewController($controller, $filter, $scope, $stateParams, DeleteConsultationAction, data, router) {
		var _this = this;
		
		/**
		 * Indicates whether the view is ready.
		 */
		var ready = false;
		
		/**
		 * Returns the template's URL.
		 */
		_this.getTemplateUrl = function() {
			return 'app/view/consultation/consultation.html';
		};
		
		/**
		 * Returns the title to be set when the view is ready.
		 */
		_this.getTitle = function() {
			return 'Consulta médica del ' + $filter('date')($scope.consultation.date, 'dd/MM/yyyy');
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
			
			// Includes controllers
			$scope.account = $controller('AccountController');
			
			// Resets the data service
			data.reset(2, {
				Consultation: [
					'creator',
					'lastEditor',
					'clinicalImpression',
					'diagnosis',
					'medicalAntecedents',
					'medicines',
					'laboratoryTestResults',
					'imagingTestResults',
					'cognitiveTestResults',
					'treatments',
					'studies'
				],
				
				Study: [
					'experiment'
				]
			});
			
			// Gets the consultation
			data.getConsultation(id).then(function(consultation) {
				// Includes the consultation
				$scope.consultation = consultation;
				
				// Initializes actions
				initializeDeleteConsultationAction(consultation);
				
				ready = true;
			});
		}
		
		/**
		 * Initializes the delete-consultation action.
		 * 
		 * Receives the consultation.
		 */
		function initializeDeleteConsultationAction(consultation) {
			// Initializes the action
			var action = new DeleteConsultationAction();
			
			// Sets inputs' initial values
			action.input.id.value = consultation.id;
			action.input.version.value = consultation.version;
			
			// Registers callbacks
			
			action.startCallback = function() {
				ready = false;
			};
			
			action.successCallback = function() {
				// Redirects the user to the patient state
				router.redirect('patient', {
					id: consultation.patient
				});
			};
			
			// Includes the action
			$scope.deleteConsultationAction = action;
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();
