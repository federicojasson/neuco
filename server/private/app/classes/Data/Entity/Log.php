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

namespace App\Data\Entity;

/**
 * Represents a log from the database.
 * 
 * Annotations:
 * 
 * @Entity
 * @Table(name="logs")
 * @HasLifecycleCallbacks
 */
class Log {
	
	/**
	 * The creation date-time.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="creation_date_time",
	 *		type="datetime",
	 *		nullable=false
	 *	)
	 */
	private $creationDateTime;
	
	/**
	 * The ID.
	 * 
	 * Annotations:
	 * 
	 * @Id
	 * @GeneratedValue(strategy="CUSTOM")
	 * @CustomIdGenerator(class="App\Data\IdGenerator\Random")
	 * @Column(
	 *		name="id",
	 *		type="binary_data",
	 *		length=16,
	 *		nullable=false,
	 *		options={
	 *			"fixed": true
	 *		}
	 *	)
	 */
	private $id;
	
	/**
	 * The level.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="level",
	 *		type="smallint",
	 *		nullable=false,
	 *		options={
	 *			"unsigned": true
	 *		}
	 *	)
	 */
	private $level;
	
	/**
	 * The message.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="message",
	 *		type="text",
	 *		nullable=false
	 *	)
	 */
	private $message;
	
	/**
	 * Serializes the entity.
	 */
	public function serialize() {
		$serialized = [];
		
		// Adds the appropriate fields
		// The process only considers accessible fields and it filters them
		// according to their specific characteristics
		
		$serialized['id'] = bin2hex($this->id);
		$serialized['creationDateTime'] = $this->creationDateTime->format(\DateTime::ISO8601);
		$serialized['level'] = $this->level;
		$serialized['message'] = $this->message;
		
		return $serialized;
	}
	
	/**
	 * Sets the creation date-time.
	 * 
	 * Annotations:
	 * 
	 * @PrePersist
	 */
	public function setCreationDateTime() {
		$this->creationDateTime = new \DateTime();
	}
	
	/**
	 * Sets the level.
	 * 
	 * Receives the level to be set.
	 */
	public function setLevel($level) {
		$this->level = $level;
	}
	
	/**
	 * Sets the message.
	 * 
	 * Receives the message to be set.
	 */
	public function setMessage($message) {
		$this->message = $message;
	}
	
}
