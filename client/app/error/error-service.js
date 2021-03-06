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
	angular.module('app.error').service('error', errorService);
	
	/**
	 * Manages the errors.
	 */
	function errorService() {
		var _this = this;
		
		/**
		 * The error descriptions.
		 */
		var descriptions = {
			FILE_SYSTEM_ERROR: '' +
				'Se ha producido un error interno en el sistema de archivos.\n' +
				'Si el problema persiste, contáctenos.',
			
			INVALID_REQUEST: '' +
				'Se ha recibido una solicitud no válida.\n' +
				'Por favor, contáctenos.',
			
			NON_EXISTENT_ENTITY: '' +
				'Se ha intentado acceder a una entidad que no existe o que no se encuentra disponible.',
			
			OUTDATED_ENTITY: '' +
				'Se ha intentado modificar una entidad desactualizada.\n' +
				'Puede que otro usuario se encuentre editándola al mismo tiempo.',
			
			SYSTEM_UNDER_MAINTENANCE: '' +
				'El sistema se encuentra en mantenimiento.\n' +
				'Reintente ingresar más tarde.',
			
			UNAUTHORIZED_USER: '' +
				'Se ha denegado el acceso.\n' +
				'Puede que su sesión haya expirado.',
			
			UNDEFINED_SERVICE: '' +
				'Se ha solicitado un servicio no definido.\n' +
				'Por favor, contáctenos.',
			
			UNDELIVERED_EMAIL: '' +
				'No se ha podido enviar un correo electrónico.\n' +
				'Si el problema persiste, contáctenos.',
			
			UNEXPECTED_ERROR: '' +
				'Se ha producido un error inesperado.\n' +
				'Si esto ocurre frecuentemente, contáctenos.'
		};
		
		/**
		 * The occurred error.
		 */
		var error = null;
		
		/**
		 * Returns the occurred error.
		 */
		_this.get = function() {
			return error;
		};
		
		/**
		 * Determines whether an error has occurred.
		 */
		_this.occurred = function() {
			return error !== null;
		};
		
		/**
		 * Reports an error.
		 * 
		 * Receives the server response.
		 */
		_this.report = function(response) {
			// Builds the message
			var message = 'Error ' + response.status;
			
			// Gets the error code
			var code = response.data.code;
			
			// Builds the details
			var details = '';
			details += 'Código: ' + code + '\n';
			details += '\n';
			details += 'Descripción:\n';
			details += descriptions[code];
			
			// Initializes the error
			error = {
				message: message,
				details: details
			};
		};
	}
})();
