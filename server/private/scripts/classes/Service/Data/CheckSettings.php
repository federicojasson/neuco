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

namespace App\Service\Data;

/**
 * TODO: comment
 */
class CheckSettings extends \App\Service\InternalService {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Initializes the orm:ensure-production-settings command
		$command = new \Doctrine\ORM\Tools\Console\Command\EnsureProductionSettingsCommand();
		
		// Initializes the input and output settings
		$inputSettings = new \Symfony\Component\Console\Input\ArrayInput([]);
		$outputSettings = new \Symfony\Component\Console\Output\ConsoleOutput();
		
		// Executes the command
		$app->data->executeCommand($command, $inputSettings, $outputSettings);
	}
	
	/**
	 * Determines whether the input is valid.
	 */
	protected function isInputValid() {
		// The service has no input
		return true;
	}
	
}