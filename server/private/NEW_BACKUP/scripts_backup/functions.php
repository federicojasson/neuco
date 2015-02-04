<?php

/*
 * This script defines global functions.
 */

/*
 * TODO: move to Database helper?
 * 
 * Returns a boolean expression from a regular one.
 * 
 * The returned boolean expression is a sanitized version with wildcards.
 * 
 * It receives the expression.
 */
function getBooleanExpression($expression) {
	// Sanitizes the expression
	$expression = iconv(CHARACTER_ENCODING_UTF8, 'ASCII//TRANSLIT//IGNORE', $expression);
	$expression = preg_replace('/[^ 0-9A-Za-z]/', '', $expression);

	if (isStringEmpty($expression)) {
		// The sanitized expression is empty
		return '';
	}

	// Gets the words of the expression
	$expressionWords = explode(' ', $expression);

	// Computes the words of the boolean expression
	$booleanExpressionWords = [];
	foreach ($expressionWords as $expressionWord) {
		// Adds a wildcard to the end of the word
		$booleanExpressionWords[] = $expressionWord . '*';
	}

	// Builds the boolean expression concatenating the computed words
	$booleanExpression = implode(' ', $booleanExpressionWords);

	return $booleanExpression;
}

/*
 * Returns the first element of an array. If the array is empty, null is
 * returned.
 * 
 * It receives the array.
 */
function getFirstElementOrNull($array) {
	if (count($array) === 0) {
		// The array is empty
		return null;
	}

	// Returns the first element
	return $array[0];
}

/*
 * TODO: move to Database helper?
 * 
 * Returns an ORDER BY clause from a sorting.
 * 
 * It receives the sorting.
 */
function getOrderByClause($sorting) {
	// Gets the sorting's field and order
	$field = $sorting['field'];
	$order = $sorting['order'];
	
	// Initializes the clause
	$clause = '';
	
	// Appends the field and the order in which the results should be sorted
	$clause .= $field;
	$clause .= ' ';
	$clause .= ($order === SORTING_ORDER_ASCENDING)? 'ASC' : 'DESC';
	
	return $clause;
}

/*
 * TODO: move to Database helper?
 * 
 * Returns a SELECT clause from a set of fields.
 * 
 * It receives the fields and their aliases in an associative array.
 */
function getSelectClause($fieldsAndAliases) {
	// Initializes the clause
	$clause = '';
	
	// Builds the clause appending the fields and their aliases
	$separator = '';
	foreach ($fieldsAndAliases as $field => $alias) {
		$clause .= $separator . $field . ' AS ' . $alias;
		$separator = ', ';
	}
	
	return $clause;
}

/*
 * Returns the length of a string.
 * 
 * It receives the string.
 */
function getStringLength($string) {
	return mb_strlen($string, CHARACTER_ENCODING_UTF8);
}

/*
 * Determines whether an array is sequential.
 * 
 * It receives the array.
 */
function isSequentialArray($array) {
	// Initializes an array with the sequential indices
	$indices = range(0, count($array) - 1);

	// Compares the keys of the array with the indices and returns the result
	return array_keys($array) === $indices;
}

/*
 * Determines whether a string is empty.
 * 
 * It receives the string.
 */
function isStringEmpty($string) {
	return getStringLength($string) === 0;
}

/*
 * Reads the content of a JSON file, decodes it and returns the result.
 * 
 * It receives the file's path.
 */
function readJsonFile($path) {
	// Gets the file's content
	$content = file_get_contents($path);

	// Decodes the content and returns the result
	return json_decode($content, true);
}

/*
 * Reads the content of a template file, replaces its placeholders and returns
 * the result.
 * 
 * It receives the file's path and a mapping containing placeholders as its keys
 * and replacements as its values.
 */
function readTemplateFile($path, $mapping) {
	// Gets the file's content
	$content = file_get_contents($path);
	
	// Replaces the placeholders and returns the result
	return replacePlaceholders($content, $mapping);
}

/*
 * Given a string with placeholders, it replaces them with specific strings and
 * returns the result.
 * 
 * It receives the string and a mapping containing placeholders as its keys and
 * replacements as its values.
 */
function replacePlaceholders($string, $mapping) {
	// Gets the placeholders and the replacements in different arrays
	$placeholders = array_keys($mapping);
	$replacements = array_values($mapping);

	// Replaces the placeholders and returns the result
	return str_replace($placeholders, $replacements, $string);
}

/*
 * Trims a string, removing duplicate, leading and trailing whitespaces.
 * 
 * It receives the string.
 */
function trimString($string) {
	// Removes duplicate whitespaces
	$string = preg_replace('/[ ]+/', ' ', $string);
	
	// Removes leading and trailing whitespaces
	$string = trim($string, ' ');
	
	return $string;
}