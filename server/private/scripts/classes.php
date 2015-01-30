<?php

/*
 * This script includes the classes of the application.
 */

require 'private/scripts/Auxiliars/SessionStorageHandler.php';
require 'private/scripts/Auxiliars/DatabaseLogWriter.php';
require 'private/scripts/Auxiliars/DatabaseSessionStorageHandler.php';
require 'private/scripts/Auxiliars/JsonStructureDescriptor.php';
require 'private/scripts/Controllers/Controller.php';
require 'private/scripts/Controllers/SecureController.php';
require 'private/scripts/Controllers/Account/Edit.php';
require 'private/scripts/Controllers/Account/EditPassword.php';
require 'private/scripts/Controllers/Account/Get.php';
require 'private/scripts/Controllers/Account/GetState.php';
require 'private/scripts/Controllers/Account/RecoverPassword.php';
require 'private/scripts/Controllers/Account/SignIn.php';
require 'private/scripts/Controllers/Account/SignOut.php';
require 'private/scripts/Controllers/Account/SignUp.php';
require 'private/scripts/Controllers/Backgrounds/Create.php';
require 'private/scripts/Controllers/Backgrounds/Delete.php';
require 'private/scripts/Controllers/Backgrounds/Edit.php';
require 'private/scripts/Controllers/Backgrounds/Get.php';
require 'private/scripts/Controllers/Backgrounds/Search.php';
require 'private/scripts/Controllers/ClinicalImpressions/Create.php';
require 'private/scripts/Controllers/ClinicalImpressions/Delete.php';
require 'private/scripts/Controllers/ClinicalImpressions/Edit.php';
require 'private/scripts/Controllers/ClinicalImpressions/Get.php';
require 'private/scripts/Controllers/ClinicalImpressions/Search.php';
require 'private/scripts/Controllers/Consultations/Create.php';
require 'private/scripts/Controllers/Consultations/Delete.php';
require 'private/scripts/Controllers/Consultations/Edit.php';
require 'private/scripts/Controllers/Consultations/Get.php';
require 'private/scripts/Controllers/Diagnoses/Create.php';
require 'private/scripts/Controllers/Diagnoses/Delete.php';
require 'private/scripts/Controllers/Diagnoses/Edit.php';
require 'private/scripts/Controllers/Diagnoses/Get.php';
require 'private/scripts/Controllers/Diagnoses/Search.php';
require 'private/scripts/Controllers/ImageTests/Create.php';
require 'private/scripts/Controllers/ImageTests/Delete.php';
require 'private/scripts/Controllers/ImageTests/Edit.php';
require 'private/scripts/Controllers/ImageTests/Get.php';
require 'private/scripts/Controllers/ImageTests/Search.php';
require 'private/scripts/Controllers/LaboratoryTests/Create.php';
require 'private/scripts/Controllers/LaboratoryTests/Delete.php';
require 'private/scripts/Controllers/LaboratoryTests/Edit.php';
require 'private/scripts/Controllers/LaboratoryTests/Get.php';
require 'private/scripts/Controllers/LaboratoryTests/Search.php';
require 'private/scripts/Controllers/Medications/Create.php';
require 'private/scripts/Controllers/Medications/Delete.php';
require 'private/scripts/Controllers/Medications/Edit.php';
require 'private/scripts/Controllers/Medications/Get.php';
require 'private/scripts/Controllers/Medications/Search.php';
require 'private/scripts/Controllers/NeurocognitiveTests/Create.php';
require 'private/scripts/Controllers/NeurocognitiveTests/Delete.php';
require 'private/scripts/Controllers/NeurocognitiveTests/Edit.php';
require 'private/scripts/Controllers/NeurocognitiveTests/Get.php';
require 'private/scripts/Controllers/NeurocognitiveTests/Search.php';
require 'private/scripts/Controllers/Patients/Create.php';
require 'private/scripts/Controllers/Patients/Delete.php';
require 'private/scripts/Controllers/Patients/Edit.php';
require 'private/scripts/Controllers/Patients/Get.php';
require 'private/scripts/Controllers/Patients/Search.php';
require 'private/scripts/Controllers/Permissions/RecoverPassword/Create.php';
require 'private/scripts/Controllers/Permissions/RecoverPassword/Exists.php';
require 'private/scripts/Controllers/Permissions/SignUp/Create.php';
require 'private/scripts/Controllers/Permissions/SignUp/Exists.php';
require 'private/scripts/Controllers/Treatments/Create.php';
require 'private/scripts/Controllers/Treatments/Delete.php';
require 'private/scripts/Controllers/Treatments/Edit.php';
require 'private/scripts/Controllers/Treatments/Get.php';
require 'private/scripts/Controllers/Treatments/Search.php';
require 'private/scripts/Controllers/Users/Delete.php';
require 'private/scripts/Controllers/Users/Get.php';
require 'private/scripts/Extensions/Request.php';
require 'private/scripts/Extensions/Response.php';
require 'private/scripts/Helpers/Helper.php';
require 'private/scripts/Helpers/Database.php';
require 'private/scripts/Helpers/SpecializedDatabase.php';
require 'private/scripts/Helpers/Account.php';
require 'private/scripts/Helpers/Authenticator.php';
require 'private/scripts/Helpers/AuthorizationValidator.php';
require 'private/scripts/Helpers/BusinessLogicDatabase.php';
require 'private/scripts/Helpers/Cryptography.php';
require 'private/scripts/Helpers/EmailFactory.php';
require 'private/scripts/Helpers/Files.php';
require 'private/scripts/Helpers/InputValidator.php';
require 'private/scripts/Helpers/Parameters.php';
require 'private/scripts/Helpers/Services.php';
require 'private/scripts/Helpers/Session.php';
require 'private/scripts/Helpers/WebServerDatabase.php';
require 'private/scripts/Middlewares/Configurations.php';
require 'private/scripts/Middlewares/ErrorHandlers.php';
require 'private/scripts/Middlewares/Extensions.php';
require 'private/scripts/Middlewares/Helpers.php';
require 'private/scripts/Middlewares/Services.php';
require 'private/scripts/Middlewares/Session.php';
