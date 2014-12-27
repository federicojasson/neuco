// Uses strict mode in the whole script
'use strict';

(function() {
	// Module: utilities
	var module = angular.module('utilities');
	
	// Filter: honorificName
	module.filter('honorificName', honorificNameFilter);
	
	/*
	 * Filter: honorificName
	 * 
	 * Given a user, it returns her honorific name.
	 */
	function honorificNameFilter() {
		/*
		 * The honorific titles, organized according to user role and gender.
		 */
		var honorificTitles = {
			ad: {
				f: 'Sra.',
				m: 'Sr.'
			},
			
			dr: {
				f: 'Dra.',
				m: 'Dr.'
			},
			
			op: {
				f: 'Sra.',
				m: 'Sr.'
			}
		};
		
		/*
		 * Filters the input.
		 * 
		 * It receives the input.
		 */
		function filter(user) {
			var userLastNames = user.lastNames;
			var userGender = user.gender;
			var userRole = user.role;
			
			// Gets the user's honorific title
			var honorificTitle = honorificTitles[userRole][userGender];
			
			// Composes and returns the user's honorific name
			return honorificTitle + ' ' + userLastNames;
		}
		
		return filter;
	}
})();