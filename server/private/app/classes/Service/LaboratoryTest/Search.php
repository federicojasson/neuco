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

namespace App\Service\LaboratoryTest;

/**
 * Represents the /laboratory-test/search service.
 */
class Search extends \App\Service\External {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets inputs
		$expression = $this->getInputValue('expression', 'buildBooleanExpression');
		$sortingCriteria = $this->getInputValue('sortingCriteria', 'filterSortingCriteria');
		$page = $this->getInputValue('page');
		$resultsPerPage = $this->getInputValue('resultsPerPage');
		
		// Initializes a query builder
		$queryBuilder = $app->data->createQueryBuilder()
			->select('lt.id')
			->from('Entity:LaboratoryTest', 'lt')
			->where('lt.deleted = false');
		
		if (! is_null($expression)) {
			// A full-text search is to be performed
			$queryBuilder
				->andWhere('MATCH(lt.name) AGAINST(:expression BOOLEAN) > 0')
				->setParameter('expression', $expression);
		}
		
		// Sets the sorting criteria
		foreach ($sortingCriteria as $field => $direction) {
			$queryBuilder->addOrderBy('lt.' . $field, $direction);
		}
		
		// Searches the laboratory tests
		$laboratoryTests = $queryBuilder
			->getQuery()
			->setFirstResult(calculateSearchOffset($page, $resultsPerPage))
			->setMaxResults($resultsPerPage)
			->setHint(\Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER, 'App\Data\OutputWalker\Custom')
			->setHint('hint.sqlCalcFoundRows', true)
			->getResult();
		
		// Sets an output
		$this->setOutputValue('results', $laboratoryTests, createArrayFilter(function($laboratoryTest) {
			return bin2hex($laboratoryTest['id']);
		}));
		
		// Gets the total number of results
		$total = $app->data->getFoundRows();
		
		// Sets an output
		$this->setOutputValue('total', $total);
	}
	
	/**
	 * Determines whether the request is valid.
	 */
	protected function isRequestValid() {
		global $app;
		
		if (! $this->isJsonRequest()) {
			// It is not a JSON request
			return false;
		}
		
		// Gets the input
		$input = $this->getInput();
		
		// Builds an input validator
		$inputValidator = new \App\InputValidator\Input\InputObject([
			'expression' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
				return is_null($input) || $app->inputValidator->isValidLine($input, 0, 128);
			}),
			
			'sortingCriteria' => new \App\InputValidator\Input\InputArray(
				new \App\InputValidator\Input\InputObject([
					'field' => new \App\InputValidator\Input\InputValue(function($input) {
						return inArray($input, [
							'creationDateTime',
							'lastEditionDateTime',
							'name',
							'creator',
							'lastEditor'
						]);
					}),

					'direction' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
						return $app->inputValidator->isSortingDirection($input);
					})
				])
			),
			
			'page' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
				return $app->inputValidator->isValidInteger($input, 1);
			}),
			
			'resultsPerPage' => new \App\InputValidator\Input\InputValue(function($input) use ($app) {
				return $app->inputValidator->isValidInteger($input, 1);
			})
		]);
		
		if (! $app->inputValidator->isInputValid($input, $inputValidator)) {
			// The input is invalid
			return false;
		}
		
		// Gets inputs
		$sortingCriteria = $this->getInputValue('sortingCriteria');
		$page = $this->getInputValue('page');
		$resultsPerPage = $this->getInputValue('resultsPerPage');
		
		if (! $app->inputValidator->areSortingCriteriaValid($sortingCriteria)) {
			// The sorting criteria are invalid
			return false;
		}
		
		if (! $app->inputValidator->isSearchOffsetValid($page, $resultsPerPage)) {
			// The search offset is invalid
			return false;
		}
		
		return true;
	}
	
	/**
	 * Determines whether the user is authorized.
	 */
	protected function isUserAuthorized() {
		global $app;
		
		// Validates the access
		return $app->accessValidator->isUserAuthorized([
			USER_ROLE_ADMINISTRATOR
		]);
	}

}
