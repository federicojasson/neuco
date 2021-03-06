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

namespace App\Data\IdGenerator;

/**
 * Responsible for generating random IDs for entities from the database.
 */
class Random extends \Doctrine\ORM\Id\AbstractIdGenerator {

	/**
	 * Generates an entity's ID.
	 * 
	 * Receives the entity manager and the entity.
	 */
	public function generate(\Doctrine\ORM\EntityManager $entityManager, $entity) {
		global $app;
		
		// Generates a random ID
		return $app->cryptography->generateRandomId();
	}

}
