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

/**
 * This script defines global functions.
 */

/*
 * Creates an array filter.
 * 
 * Receives a filter for the elements.
 */
function createArrayFilter($filter) {
	return function($array) use ($filter) {
		// Applies the filter to the array's elements
		foreach ($array as &$element) {
			$element = call_user_func($filter, $element);
		}

		return $array;
	};
}

/**
 * Returns the client's IP address.
 */
function getClientIpAddress() {
	// Gets the IP address
	$ipAddress = $_SERVER['REMOTE_ADDR'];
	
	// Converts the IP address to its in_addr representation
	$ipAddress = inet_pton($ipAddress);
	
	if ($ipAddress === false) {
		// The IP address is invalid
		return 'unknown';
	}
	
	// Defines the IPv4-mapped IPv6 address prefix and gets its length
	$prefix = hex2bin('00000000000000000000ffff');
	$length = strlen($prefix);
	
	if ($prefix === substr($ipAddress, 0, $length)) {
		// The IP address is an IPv4-mapped IPv6 address
		// Removes the prefix
		$ipAddress = substr($ipAddress, $length);
	}
	
	// Converts the IP address back to a human-readable format
	$ipAddress = inet_ntop($ipAddress);
	
	return $ipAddress;
}

/**
 * Returns the current date-time.
 */
function getCurrentDateTime() {
	// Initializes the time zone (UTC for consistency)
	$timeZone = new \DateTimeZone('UTC');
	
	// Initializes the current date-time
	return new \DateTime(null, $timeZone);
}

/**
 * Determines whether an array contains a certain element.
 * 
 * Receives the element and the array.
 */
function inArray($element, $array) {
	return in_array($element, $array, true);
}

/**
 * Determines whether a value is in a certain range.
 * 
 * Receives the value, the lower bound and, optionally, the upper.
 */
function inRange($value, $lowerBound, $upperBound = null) {
	// Initializes the upper bound if is null
	$upperBound = (! is_null($upperBound))? $upperBound : $value;
	
	// Determines whether the value is in the specified range
	return $value >= $lowerBound && $value <= $upperBound;
}

/**
 * Determines whether an array is sequential.
 * 
 * Receives the array.
 */
function isArraySequential($array) {
	// Gets the array's length
	$length = count($array);
	
	if ($length === 0) {
		// The array is empty
		return true;
	}
	
	// Initializes an array containing the sequential indices
	$indices = range(0, $length - 1);
	
	// Compares the indices with the array's keys
	return $indices === array_keys($array);
}

/**
 * Reads the contents of a JSON file.
 * 
 * Receives the file's path.
 */
function readJsonFile($path) {
	// Reads the contents of the file
	$contents = file_get_contents($path);
	
	// Decodes the contents
	return json_decode($contents, true);
}

/**
 * Reads the contents of a template file and replaces its placeholders.
 * 
 * Receives the file's path and a mapping containing placeholders as keys and
 * replacements as values.
 */
function readTemplateFile($path, $mapping) {
	// Reads the contents of the file
	$contents = file_get_contents($path);
	
	// Replaces the placeholders
	return replacePlaceholders($contents, $mapping);
}

/**
 * Given a string with placeholders, it replaces them with specific strings.
 * 
 * Receives the string and a mapping containing placeholders as keys and
 * replacements as values.
 */
function replacePlaceholders($string, $mapping) {
	// Gets the placeholders and the replacements in different arrays
	$placeholders = array_keys($mapping);
	$replacements = array_values($mapping);
	
	// Prepends a colon to each placeholder
	foreach ($placeholders as &$placeholder) {
		$placeholder = ':' . $placeholder;
	}

	// Replaces the placeholders
	return str_replace($placeholders, $replacements, $string);
}

/**
 * Converts a string from spinal-case to PascalCase.
 * 
 * Receives the string.
 */
function spinalToPascalCase($string) {
	// Replaces the dashes with spaces
	$string = str_replace('-', ' ', $string);
	
	// Converts the first character of each word to uppercase
	$string = ucwords($string);
	
	// Removes the spaces
	return str_replace(' ', '', $string);
}

/**
 * Trims and shrinks a string.
 * 
 * Receives the string.
 */
function trimAndShrink($string) {
	// Shrinks the string
	$string = preg_replace('/ +/', ' ', $string);
	
	// Trims the string
	return trim($string, ' ');
}
