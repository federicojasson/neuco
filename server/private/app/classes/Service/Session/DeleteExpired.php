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

namespace App\Service\Session;

/**
 * Represents the /session/delete-expired service.
 */
class DeleteExpired extends \App\Service\Internal {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Acquires a lock
		$lockAcquired = $app->lock->acquire('session-delete-expired');
		
		if (! $lockAcquired) {
			// The lock could not be acquired
			return;
		}
		
		// Gets the current date-time
		$currentDateTime = new \DateTime();
		
		// Deletes the expired sessions
		$app->data->createQueryBuilder()
			->delete('Entity:Session', 's')
			->where('s.creationDateTime < DATEADD(:currentDateTime, (-:maximumAge), \'DAY\')')
			->orWhere('s.lastAccessDateTime < DATEADD(:currentDateTime, (-:maximumInactivityTime), \'HOUR\')')
			->setParameter('currentDateTime', $currentDateTime)
			->setParameter('maximumAge', SESSION_MAXIMUM_AGE)
			->setParameter('maximumInactivityTime', SESSION_MAXIMUM_INACTIVITY_TIME)
			->getQuery()
			->execute();
	}
	
	/**
	 * Determines whether the request is valid.
	 */
	protected function isRequestValid() {
		return true;
	}
	
}
