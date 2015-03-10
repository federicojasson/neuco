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

// TODO: check all the file
(function() {
	angular.module('app.navigationBar').provider('navigationBar', navigationBarProvider);
	
	/**
	 * Responsible for initializing the navigation-bar service.
	 */
	function navigationBarProvider() {
		var _this = this;
		
		/**
		 * The registered menus.
		 */
		var menus = {
			ad: [],
			dr: [],
			op: []
		};
		
		/**
		 * Initializes the navigation-bar service.
		 */
		_this.$get = [
			'authentication',
			function(authentication) {
				// Initializes the navigation-bar service
				var navigationBar = new navigationBarService(authentication);

				// TODO: comment
				navigationBar.setMenus(menus);

				return navigationBar;
			}
		];
		
		/**
		 * Registers a menu.
		 * 
		 * Receives TODO: comment
		 */
		_this.registerMenu = function(menu, userRole) {
			menus[userRole].push(menu);
		};
	}
	
	/**
	 * Manages the navigation-bar.
	 */
	function navigationBarService(authentication) {
		var _this = this;
		
		/**
		 * TODO: comment
		 */
		var menus; // TODO: initialize?
		
		/**
		 * TODO: comment
		 */
		_this.getMenus = function() {
			// Gets the signed-in user's role
			var userRole = authentication.getSignedInUser().role;
			
			// Returns the menus
			return menus[userRole];
		};
		
		/**
		 * TODO: comment
		 */
		_this.setMenus = function(newMenus) {
			menus = newMenus;
		};
	}
})();
