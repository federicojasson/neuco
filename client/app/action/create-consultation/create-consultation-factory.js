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
	angular.module('app.action.createConsultation').factory('CreateConsultationAction', [
		'inputValidator',
		'Input',
		'server',
		CreateConsultationActionFactory
	]);
	
	/**
	 * Defines the CreateConsultationAction class.
	 */
	function CreateConsultationActionFactory(inputValidator, Input, server) {
		/**
		 * The input.
		 */
		CreateConsultationAction.prototype.input;
		
		/**
		 * The start callback.
		 */
		CreateConsultationAction.prototype.startCallback;
		
		/**
		 * The success callback.
		 */
		CreateConsultationAction.prototype.successCallback;
		
		/**
		 * Initializes an instance of the class.
		 */
		function CreateConsultationAction() {
			this.startCallback = new Function();
			this.successCallback = new Function();
			
			// Initializes the input
			this.input = {
				date: new Input(function() {
					return inputValidator.isDate(this);
				}),
				
				patientImpression: new Input(function() {
					return inputValidator.isValidString(this, 0, 256);
				}),
				
				presentingProblem: new Input(function() {
					return inputValidator.isValidString(this, 0, 1024);
				}),
				
				comments: new Input(function() {
					return inputValidator.isValidString(this, 0, 1024);
				}),
				
				patient: new Input(),
				clinicalImpression: new Input(),
				diagnosis: new Input(),
				medicalAntecedents: new Input(),
				medicines: new Input(),
				laboratoryTestResults: new Input(),
				imagingTestResults: new Input(),
				cognitiveTestResults: new Input(),
				treatments: new Input()
			};
		}
		
		/**
		 * Executes the action.
		 */
		CreateConsultationAction.prototype.execute = function() {
			if (! inputValidator.isInputValid(this.input)) {
				// The input is invalid
				return;
			}
			
			// Invokes the start callback
			this.startCallback();
			
			// Creates the consultation
			server.consultation.create({
				date: this.input.date.value,
				patientImpression: this.input.patientImpression.value,
				presentingProblem: this.input.presentingProblem.value,
				comments: this.input.comments.value,
				patient: this.input.patient.value,
				clinicalImpression: this.input.clinicalImpression.value,
				diagnosis: this.input.diagnosis.value,
				medicalAntecedents: this.input.medicalAntecedents.value,
				medicines: this.input.medicines.value,
				laboratoryTestResults: this.input.laboratoryTestResults.value,
				imagingTestResults: this.input.imagingTestResults.value,
				cognitiveTestResults: this.input.cognitiveTestResults.value,
				treatments: this.input.treatments.value
			}).then(function(output) {
				// Invokes the success callback
				this.successCallback(output.id);
			}.bind(this));
		};
		
		// ---------------------------------------------------------------------
		
		return CreateConsultationAction;
	}
})();
