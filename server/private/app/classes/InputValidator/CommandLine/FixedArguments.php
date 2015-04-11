<?php

/**
 * ETRS - Eye Tracking Record System
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

namespace App\InputValidator\CommandLine;

/**
 * Responsible for validating fixed command-line arguments.
 * 
 * "Fixed" here means that the arguments must be received in a predetermined
 * order.
 */
class FixedArguments {
	
	/**
	 * The definition.
	 */
	private $definition;
	
	/**
	 * Initializes an instance of the class.
	 * 
	 * Receives the definition.
	 */
	public function __construct($definition) {
		$this->definition = $definition;
	}
	
	/**
	 * Determines whether an input is valid.
	 * 
	 * Receives the input.
	 */
	public function isInputValid($input) {
		// Gets the definition's length
		$count = count($this->definition);
		
		if ($count !== count($input)) {
			// The input's length doesn't match that of the definition
			return false;
		}
		
		// Validates the command-line arguments
		for ($i = 0; $i < $count; $i++) {
			// Validates the argument
			$valid = call_user_func($this->definition[$i], $input[$i]);
			
			if (! $valid) {
				// The argument is invalid
				return false;
			}
		}
		
		return true;
	}
	
}
