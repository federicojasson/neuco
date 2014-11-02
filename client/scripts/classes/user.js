// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('classes');
	
	// Factories
	module.factory('User', UserFactory);
	
	/*
	 * Factory: User.
	 * 
	 * User class.
	 * It represents a user.
	 */
	function UserFactory() {
		/*
		 * Creates a user object from a data object.
		 */
		User.createFromDataObject = function(dataObject) {
			// Gets the error message and its HTTP status code
			var firstNames = dataObject.firstNames;
			var gender = dataObject.gender;
			var id = dataObject.id;
			var lastNames = dataObject.lastNames;
			var role = dataObject.role;
			
			// Creates and returns the user object
			return new User(firstNames, gender, id, lastNames, role);
		};
		
		/*
		 * The user's first names.
		 */
		User.prototype.firstNames = null;
		
		/*
		 * The user's genre.
		 */
		User.prototype.gender = null;
		
		/*
		 * The user ID.
		 */
		User.prototype.id = null;
		
		/*
		 * The user's last names.
		 */
		User.prototype.lastNames = null;
		
		/*
		 * The user's role.
		 */
		User.prototype.role = null;
		
		/*
		 * Creates an instance of this class.
		 */
		function User(firstNames, gender, id, lastNames, role) {
			this.firstNames = firstNames;
			this.gender = gender;
			this.id = id;
			this.lastNames = lastNames;
			this.role = role;
		}
		
		/*
		 * Returns the user's first names.
		 */
		User.prototype.getFirstNames = function() {
			return this.firstNames;
		};
		
		/*
		 * Returns the user's full name.
		 */
		User.prototype.getFullName = function() {
			return this.firstNames + ' ' + this.lastNames;
		};
		
		/*
		 * Returns the user's genre.
		 */
		User.prototype.getGenre = function() {
			return this.genre;
		};
		
		/*
		 * Returns the user's honorific name.
		 */
		User.prototype.getHonorificName = function() {
			// Gets the honorific title according to the user's role and gender
			var honorificTitle = honorificTitles[this.role][this.gender];
			
			// Prepends the honorific title to the user's last names
			return honorificTitle + ' ' + this.lastNames;
		};
		
		/*
		 * Returns the user ID.
		 */
		User.prototype.getId = function() {
			return this.id;
		};
		
		/*
		 * Returns the user's last names.
		 */
		User.prototype.getLastNames = function() {
			return this.lastNames;
		};
		
		/*
		 * Returns the user's role.
		 */
		User.prototype.getRole = function() {
			return this.role;
		};
		
		var honorificTitles = {
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
		
		// Returns the constructor function
		return User;
	}
})();
