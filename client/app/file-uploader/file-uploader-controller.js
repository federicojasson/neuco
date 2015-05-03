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
	angular.module('app.fileUploader').controller('FileUploaderController', [
		'$scope',
		'FileUploader',
		'utility',
		FileUploaderController
	]);
	
	/**
	 * TODO: comment
	 */
	function FileUploaderController($scope, FileUploader, utility) {
		/**
		 * Performs initialization tasks.
		 */
		function initialize() {
			// Includes auxiliary functions
			$scope.removeFileItem = removeFileItem;
			
			// Initializes the uploader
			initializeUploader($scope.limit);
		}
		
		/**
		 * Initializes the uploader.
		 * 
		 * Receives, optionally, the maximum number of files allowed.
		 */
		function initializeUploader(limit) {
			// Initializes the uploader
			var uploader = new FileUploader({
				url: '/server/file/upload',
				alias: 'file',
				method: 'POST'
			});
			
			if (angular.isDefined(limit)) {
				// Sets the maximum number of files allowed
				uploader.queueLimit = limit;
			}
			
			// Registers callbacks
			
			uploader.onAfterAddingFile = function(fileItem) {
				// Uploads the file
				fileItem.upload();
			};
			
			uploader.onBeforeUploadItem = function() {
				$scope.uploading = true;
			};
			
			uploader.onCompleteItem = function() {
				$scope.uploading = false;
			};
			
			uploader.onSuccessItem = function(fileItem, output) {
				// Adds the file's ID
				$scope.files.push(output.id);
				
				// Stores the file's ID in the file item
				fileItem.file.id = output.id;
			};
			
			// Includes the uploader
			$scope.uploader = uploader;
		}
		
		/**
		 * Removes a file item.
		 * 
		 * Receives the file item.
		 */
		function removeFileItem(fileItem) {
			// Removes the file's ID
			utility.removeFromArray(fileItem.file.id, $scope.files);
			
			// Removes the file item
			fileItem.remove();
		}
		
		// ---------------------------------------------------------------------
		
		// Initializes the controller
		initialize();
	}
})();