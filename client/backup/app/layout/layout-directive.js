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
	angular.module('app.layout').directive('layout', [
		'$controller',
		'layout',
		'title',
		layoutDirective
	]);
	
	/**
	 * Includes the layout.
	 */
	function layoutDirective($controller, layout, title) {
		/**
		 * Returns the settings of the directive.
		 */
		function getSettings() {
			return {
				restrict: 'E',
				scope: {},
				link: registerLayoutListener,
				templateUrl: 'app/layout/layout.html'
			};
		}
		
		/**
		 * Registers a listener for the layout.
		 * 
		 * Receives the scope of the directive.
		 */
		function registerLayoutListener(scope) {
			// Listens for changes in the layout
			scope.$watch(layout.get, function(layout) {
				// Defines an object to share the scope with the new layout
				var locals = {
					$scope: scope
				};
				
				// TODO: comment and order (use one function)
				var controller = $controller(layout, locals);
				
				scope.$watch(controller.getTitle, function() {
					if (controller.isReady()) {
						title.set(controller.getTitle());
					} else {
						title.set('Cargando...');
					}
				});
				
				scope.$watch(controller.isReady, function() {
					if (controller.isReady()) {
						title.set(controller.getTitle());
					} else {
						title.set('Cargando...');
					}
				});
				
				// Includes the new layout
				scope.layout = controller;
			});
		}
		
		// ---------------------------------------------------------------------
		
		// Returns the settings of the directive
		return getSettings();
	}
})();