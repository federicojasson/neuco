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
	angular.module('app.layout.site').controller('SiteLayoutController', [
		'$controller',
		'$scope',
		'SignOutAction',
		'authentication',
		SiteLayoutController
	]);
	
	/**
	 * Represents the site layout.
	 */
	function SiteLayoutController($controller, $scope, SignOutAction, authentication) {
		var _this = this;
		
		/**
		 * Indicates whether the layout is ready, considering the local factors.
		 * 
		 * Since it considers only the local factors, it doesn't necessarily
		 * determine on its own whether the layout is ready.
		 */
		var ready = true;
		
		/**
		 * Returns the URL of the template.
		 */
		_this.getTemplateUrl = function() {
			return 'app/layout/site/site.html';
		};
		
		/**
		 * Returns the title to be set when the layout is ready.
		 */
		_this.getTitle = function() {
			return '';
		};
		
		/**
		 * Determines whether the layout is ready.
		 */
		_this.isReady = function() {
			return ready && ! authentication.isStateRefreshing();
		};
		
		/**
		 * TODO: comment
		 */
		function decideName1() { // TODO: rename function
			// TODO: comment
			ready = false;
		}
		
		/**
		 * TODO: comment
		 */
		function decideName2() { // TODO: rename function
			// TODO: comment
			ready = true;
		}
		
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Includes the necessary controllers
			$scope.authentication = $controller('AuthenticationController');
			
			// Initializes the sign-out action
			var signOutAction = new SignOutAction();
			signOutAction.startCallback = decideName1;
			signOutAction.successCallback = decideName2;
			
			// Includes the actions
			$scope.action = {
				signOut: signOutAction
			};
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the layout
		initialize();
	}
})();
