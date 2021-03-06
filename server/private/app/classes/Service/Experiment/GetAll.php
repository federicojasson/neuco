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

namespace App\Service\Experiment;

/**
 * Represents the /experiment/get-all service.
 */
class GetAll extends \App\Service\External {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Gets all experiments
		$experiments = $app->data->createQueryBuilder()
			->select('e.id')
			->from('Entity:Experiment', 'e')
			->where('e.deleted = false')
			->addOrderBy('e.name', 'ASC')
			->getQuery()
			->getResult();
		
		// Sets an output
		$this->setOutputValue('ids', $experiments, createArrayFilter(function($experiment) {
			return bin2hex($experiment['id']);
		}));
	}
	
	/**
	 * Determines whether the request is valid.
	 */
	protected function isRequestValid() {
		return true;
	}
	
	/**
	 * Determines whether the user is authorized.
	 */
	protected function isUserAuthorized() {
		global $app;
		
		// Validates the access
		return $app->accessValidator->isUserAuthorized([
			USER_ROLE_ADMINISTRATOR,
			USER_ROLE_DOCTOR,
			USER_ROLE_OPERATOR
		]);
	}

}
