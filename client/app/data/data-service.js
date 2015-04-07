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
	angular.module('app.data').service('data', [
		'$q',
		'server',
		'utility',
		dataService
	]);
	
	/**
	 * Provides data-related functionalities.
	 * 
	 * TODO: what about depth when loading data?
	 * TODO: idea --> create a provider to generate the service dynamically
	 */
	function dataService($q, server, utility) {
		var _this = this;
		
		/**
		 * TODO: remove
		 */
		_this.getSignedInUser = function() {
			var deferredTask = $q.defer();
			
			deferredTask.resolve({
				role: 'ad',
				firstName: 'Federico',
				lastName: 'Jasson',
				gender: 'm'
			});

			return deferredTask.promise;
		};
		
		/**
		 * The cache.
		 */
		var cache = {};
		
		/**
		 * The types of entities to consider.
		 * 
		 * When loading an entity, it determines what associations should be
		 * loaded as well.
		 */
		var types = [];
		
		/**
		 * Gets a medicine.
		 * 
		 * Receives the medicine's ID.
		 */
		_this.getMedicine = function(id) {
			return getEntity('Medicine', id);
		};
		
		/**
		 * Gets a user.
		 * 
		 * Receives the user's ID.
		 */
		_this.getUser = function(id) {
			return getEntity('User', id);
		};
		
		/**
		 * Resets the service.
		 * 
		 * It flushes the cache and sets the types of entities to consider.
		 * 
		 * Receives the types of entities to consider.
		 */
		_this.reset = function(newTypes) {
			// Resets the cache
			cache = {
				Medicine: {},
				User: {}
				// DEFINEHERE: define entities here
			};
			
			// Sets the types of entities to consider
			types = newTypes;
		};
		
		/**
		 * Unserializes a medicine.
		 * 
		 * Receives the medicine.
		 */
		_this.unserializeMedicine = function(medicine) {
			// TODO: comments

			var deferredTask = $q.defer();
			
			var creator = medicine.creator;
			var lastEditor = medicine.lastEditor;

			var promises = {
				creator: _this.getUser(creator),
				lastEditor: _this.getUser(lastEditor)
			};
			
			$q.all(promises).then(function(values) {
				medicine.creator = values.creator;
				medicine.lastEditor = values.lastEditor;

				deferredTask.resolve(medicine);
			});

			return deferredTask.promise;
		};
		
		/**
		 * Unserializes a user
		 * 
		 * Receives the user.
		 */
		_this.unserializeUser = function(user) {
			// TODO: comments

			var deferredTask = $q.defer();
			
			var creator = user.creator;

			var promises = {
				creator: _this.getUser(creator)
			};
			
			$q.all(promises).then(function(values) {
				user.creator = values.creator;

				deferredTask.resolve(user);
			});

			return deferredTask.promise;
		};
		
		/**
		 * Gets an entity.
		 * 
		 * It searches the entity in the cache before loading it to avoid
		 * unnecessary queries to the server.
		 * 
		 * Receives the type of entity and the entity's ID.
		 */
		function getEntity(type, id) {
			// TODO: comments
			
			var deferredTask = $q.defer();
			
			if (id === null) {
				deferredTask.resolve(null);
			} else {
				if (types.indexOf(type) === -1) {
					deferredTask.resolve(id);
				} else {
					var cachedEntity = cache[type][id];
					
					if (angular.isDefined(cachedEntity)) {
						deferredTask.resolve(cachedEntity);
					} else {
						var promise = loadEntity(type, id);
						
						promise.then(function(entity) {
							cache[type][id] = entity;
							deferredTask.resolve(entity);
						});
					}
				}
			}
			
			return deferredTask.promise;
		}
		
		/**
		 * Loads an entity.
		 * 
		 * Receives the type of entity and the entity's ID.
		 */
		function loadEntity(type, id) {
			// TODO: comments

			var deferredTask = $q.defer();

			server[utility.pascalToCamelCase(type)].get({
				id: id
			}).then(function(output) {
				return _this['unserialize' + type](output);
			}).then(function(entity) {
				deferredTask.resolve(entity);
			});

			return deferredTask.promise;
		}
	}
})();
