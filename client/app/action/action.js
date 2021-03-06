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
	angular.module('app.action', [
		'app.action.changePassword',
		'app.action.createClinicalImpression',
		'app.action.createCognitiveTest',
		'app.action.createConsultation',
		'app.action.createDiagnosis',
		'app.action.createExperiment',
		'app.action.createImagingTest',
		'app.action.createLaboratoryTest',
		'app.action.createMedicalAntecedent',
		'app.action.createMedicine',
		'app.action.createPatient',
		'app.action.createStudy',
		'app.action.createTreatment',
		'app.action.deleteClinicalImpression',
		'app.action.deleteCognitiveTest',
		'app.action.deleteConsultation',
		'app.action.deleteDiagnosis',
		'app.action.deleteExperiment',
		'app.action.deleteImagingTest',
		'app.action.deleteLaboratoryTest',
		'app.action.deleteMedicalAntecedent',
		'app.action.deleteMedicine',
		'app.action.deletePatient',
		'app.action.deleteStudy',
		'app.action.deleteTreatment',
		'app.action.editAccount',
		'app.action.editClinicalImpression',
		'app.action.editCognitiveTest',
		'app.action.editConsultation',
		'app.action.editDiagnosis',
		'app.action.editExperiment',
		'app.action.editFile',
		'app.action.editImagingTest',
		'app.action.editLaboratoryTest',
		'app.action.editMedicalAntecedent',
		'app.action.editMedicine',
		'app.action.editPatient',
		'app.action.editStudy',
		'app.action.editTreatment',
		'app.action.requestPasswordReset',
		'app.action.requestSignUp',
		'app.action.resetPassword',
		'app.action.searchClinicalImpressions',
		'app.action.searchCognitiveTests',
		'app.action.searchDiagnoses',
		'app.action.searchExperiments',
		'app.action.searchImagingTests',
		'app.action.searchLaboratoryTests',
		'app.action.searchLogs',
		'app.action.searchMedicalAntecedents',
		'app.action.searchMedicines',
		'app.action.searchPatients',
		'app.action.searchTreatments',
		'app.action.searchUsers',
		'app.action.signIn',
		'app.action.signOut',
		'app.action.signUp'
	]);
})();
