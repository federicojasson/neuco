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
	angular.module('app.view').service('view', [
		'$state',
		'account',
		'router',
		viewService
	]);
	
	/**
	 * Manages the views.
	 */
	function viewService($state, account, router) {
		var _this = this;
		
		/**
		 * The current view.
		 */
		var view = '';
		
		/**
		 * Returns the current view.
		 */
		_this.get = function() {
			return view;
		};
		
		/**
		 * Updates the view.
		 */
		_this.update = function() {
			// Gets the current state
			var state = $state.current;
			
			if (state.name === '') {
				// A valid state has not been established yet
				return;
			}
			
			if (account.isBeingRefreshed()) {
				// The account is being refreshed
				return;
			}
			
			// Gets the user role according to the signed-in user (if any)
			var userRole;
			if (account.isUserSignedIn()) {
				// The user is signed in
				// Gets the signed-in user's role
				userRole = account.getSignedInUser().role;
			} else {
				// The user is not signed in
				userRole = '__';
			}
			
			// Gets the views defined in the current state
			var views = state.data.views;
			
			if (! views.hasOwnProperty(userRole)) {
				// There is no view defined for the user role
				
				// Redirects the user to the home state
				router.redirect('home');
				
				return;
			}
			
			// Gets the view corresponding to the user role
			view = views[userRole];
		};
	}
})();
