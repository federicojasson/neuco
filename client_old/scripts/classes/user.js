// Uses strict mode in the whole script
'use strict';

(function() {
	// Module
	var module = angular.module('classes');
	
	// Factories
	module.factory('User', [
		'Name',
		UserFactory
	]);
	
	/*
	 * Factory: User.
	 * 
	 * User class.
	 * It represents a user.
	 */
	function UserFactory(Name) {
		/*
		 * Creates a user object from a data object.
		 */
		User.createFromDataObject = function(dataObject) {
			// Gets the user data
			var gender = dataObject.gender;
			var id = dataObject.id;
			var name = Name.createFromDataObject(dataObject.name);
			var role = dataObject.role;
			
			// Creates and returns the user object
			return new User(gender, id, name, role);
		};
		
		/*
		 * The user's genre.
		 */
		User.prototype.gender = null;
		
		/*
		 * The user's ID.
		 */
		User.prototype.id = null;
		
		/*
		 * The user's name.
		 */
		User.prototype.name = null;
		
		/*
		 * The user's role.
		 */
		User.prototype.role = null;
		
		/*
		 * Creates an instance of this class.
		 */
		function User(gender, id, name, role) {
			this.gender = gender;
			this.id = id;
			this.name = name;
			this.role = role;
		}
		
		/*
		 * Returns the user's honorific name.
		 */
		User.prototype.getHonorificName = function() {
			// Gets the honorific title according to the user's role and gender
			var honorificTitle = honorificTitles[this.role][this.gender];
			
			// Gets and returns the honorific name
			return this.name.getHonorificName(honorificTitle);
		};
		
		/*
		 * Returns the user's ID.
		 */
		User.prototype.getId = function() {
			return this.id;
		};
		
		/*
		 * The predefined honorific titles.
		 */
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