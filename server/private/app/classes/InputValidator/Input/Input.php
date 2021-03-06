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

namespace App\InputValidator\Input;

/**
 * Responsible for validating input structures.
 * 
 * An input structure can be an array, an object or a value. For each type, a
 * definition determines the way the validation is carried out:
 * 
 * - Arrays: an input validator is used, which determines how to validate the
 *   array's elements.
 * 
 * - Objects: an associative array is used, whose values are input validators
 *   that determine how to validate each property of the object.
 * 
 * - Values: a function is used, which receives and validates the value.
 */
abstract class Input {
	
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
	public abstract function isInputValid($input);
	
	/**
	 * Returns the definition.
	 */
	protected function getDefinition() {
		return $this->definition;
	}
	
}
