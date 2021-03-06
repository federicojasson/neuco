<?php

/**
 * NEU-CO - Neuro-Cognitivo
 * Copyright (C) 2015 Federico Jasson
 * 
 * This program is free software: you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option) any later
 * version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Service;

/**
 * Represents a service.
 */
abstract class Service {
	
	/**
	 * The input.
	 */
	private $input;
	
	/**
	 * The output.
	 */
	private $output;
	
	/**
	 * Prepares and executes the service.
	 */
	public function __invoke() {
		global $app;
		
		if (! $this->isUserAuthorized()) {
			// The user is unauthorized
			// Halts the application
			haltApp(HTTP_STATUS_FORBIDDEN, ERROR_CODE_UNAUTHORIZED_USER);
		}
		
		if (! $this->isRequestValid()) {
			// The request is invalid
			// Halts the application
			haltApp(HTTP_STATUS_BAD_REQUEST, ERROR_CODE_INVALID_REQUEST);
		}
		
		// Initializes the output
		$this->output = '';
		
		// Executes the service
		$this->execute();
		
		// Sets the response's body
		$app->response->setBody($this->output);
	}
	
	/**
	 * Executes the service.
	 */
	protected abstract function execute();
	
	/**
	 * Returns the input.
	 */
	protected function getInput() {
		return $this->input;
	}
	
	/**
	 * Returns an input's value.
	 * 
	 * Receives the input's key and, optionally, a filter for the value.
	 */
	protected function getInputValue($key, $filter = null) {
		// Gets the value
		$value = $this->input[$key];
		
		if (is_null($value)) {
			// The value is null
			return null;
		}
		
		if (! is_null($filter)) {
			// Applies the filter
			$value = call_user_func($filter, $value);
		}
		
		return $value;
	}
	
	/**
	 * Determines whether the request is valid.
	 */
	protected abstract function isRequestValid();
	
	/**
	 * Determines whether the user is authorized.
	 */
	protected abstract function isUserAuthorized();
	
	/**
	 * Sets the input.
	 * 
	 * Receives the input to be set.
	 */
	protected function setInput($input) {
		$this->input = $input;
	}
	
	/**
	 * Sets the output.
	 * 
	 * Receives the output to be set.
	 */
	protected function setOutput($output) {
		$this->output = $output;
	}
	
	/**
	 * Sets an output's value.
	 * 
	 * Receives the output's key, the value to be set and, optionally, a filter
	 * for the value.
	 */
	protected function setOutputValue($key, $value, $filter = null) {
		if (! is_array($this->output)) {
			// The output is not an array
			// Reinitializes the output
			$this->output = [];
		}
		
		if (! is_null($value) && ! is_null($filter)) {
			// Applies the filter
			$value = call_user_func($filter, $value);
		}
		
		// Sets the value
		$this->output[$key] = $value;
	}
	
}
