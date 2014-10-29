// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('filters', []);
	
	// Filters
	module.filter('userFullName', userFullNameFilter);
	module.filter('userHonorificName', userHonorificNameFilter);
	
	/*
	 * Filter: userFullName.
	 * 
	 * Given a user, it returns her full name.
	 */
	function userFullNameFilter() {
		var filter = this;
		
		/*
		 * Applies the filter.
		 */
		filter.applyFilter = function(user) {
			// Concatenates the first and the last names
			return user.firstNames + ' ' + user.lastNames;
		};
		
		return filter.applyFilter;
	};
	
	/*
	 * Filter: userHonorificName.
	 * 
	 * Given a user, it returns her honorific name.
	 */
	function userHonorificNameFilter() {
		var filter = this;
		
		/*
		 * Applies the filter.
		 */
		filter.applyFilter = function(user) {
			// Gets the user's honorific
			var honorific = filter.getUserHonorific(user);
			
			// Prepends the honorific to the user's last names
			return honorific + ' ' + user.lastNames;
		};
		
		/*
		 * Returns the honorific of a user, according to her role and her
		 * gender.
		 */
		filter.getUserHonorific = function(user) {
			var honorifics = {
				DR: {
					F: 'Dra.',
					M: 'Dr.'
				},
				OP: {
					F: 'Sra.',
					M: 'Sr.'
				},
				RS: {
					F: 'Sra.',
					M: 'Sr.'
				}
			};
			
			return honorifics[user.role][user.gender];
		};
		
		return filter.applyFilter;
	};
})();