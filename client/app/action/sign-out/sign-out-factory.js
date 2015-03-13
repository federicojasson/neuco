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
	angular.module('app.action.signOut').factory('SignOutAction', [
		'authentication',
		'server',
		SignOutActionFactory
	]);
	
	/**
	 * Defines the SignOutAction class.
	 */
	function SignOutActionFactory(authentication, server) {
		/**
		 * The start callback.
		 * 
		 * It is invoked at the start of the action.
		 */
		SignOutAction.prototype.startCallback;
		
		/**
		 * The success callback.
		 * 
		 * It is invoked when the action is successful.
		 */
		SignOutAction.prototype.successCallback;
		
		/**
		 * Initializes an instance of the class.
		 */
		function SignOutAction() {
			// Initializes the callbacks
			this.startCallback = function() {};
			this.successCallback = function() {};
		}
		
		/**
		 * Executes the action.
		 */
		SignOutAction.prototype.execute = function() {
			// Invokes the start callback
			this.startCallback();
			
			// Signs out the user
			server.account.signOut().then(function() {
				// Refreshes the authentication state
				authentication.refreshState();
				
				// Invokes the success callback
				this.successCallback();
			}.bind(this));
		};
		
		// ---------------------------------------------------------------------
		
		return SignOutAction;
	}
})();