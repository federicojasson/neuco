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
 * Represents a sign-up permission from the database.
 * 
 * Annotations:
 * 
 * @Entity
 * @Table(name="sign_up_permissions")
 * @HasLifecycleCallbacks
 */
class SignUpPermission {
	
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
	 * The creator.
	 * 
	 * Annotations:
	 * 
	 * @ManyToOne(targetEntity="User")
	 * @JoinColumn(
	 *		name="creator",
	 *		referencedColumnName="id",
	 *		onDelete="SET NULL"
	 *	)
	 */
	private $creator;
	
	/**
	 * The email address.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="email_address",
	 *		type="string",
	 *		length=254,
	 *		nullable=false
	 *	)
	 */
	private $emailAddress;
	
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
	 * The key-stretching iterations.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="key_stretching_iterations",
	 *		type="integer",
	 *		nullable=false,
	 *		options={
	 *			"unsigned": true
	 *		}
	 *	)
	 */
	private $keyStretchingIterations;
	
	/**
	 * The password's hash.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="password_hash",
	 *		type="binary_data",
	 *		length=64,
	 *		nullable=false,
	 *		options={
	 *			"fixed": true
	 *		}
	 *	)
	 */
	private $passwordHash;
	
	/**
	 * The salt.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="salt",
	 *		type="binary_data",
	 *		length=64,
	 *		nullable=false,
	 *		options={
	 *			"fixed": true
	 *		}
	 *	)
	 */
	private $salt;
	
	/**
	 * The user role.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="user_role",
	 *		type="binary_data",
	 *		length=2,
	 *		nullable=false,
	 *		options={
	 *			"fixed": true
	 *		}
	 *	)
	 */
	private $userRole;
	
	/**
	 * Returns the creator.
	 */
	public function getCreator() {
		return $this->creator;
	}
	
	/**
	 * Returns the ID.
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Returns the key-stretching iterations.
	 */
	public function getKeyStretchingIterations() {
		return $this->keyStretchingIterations;
	}
	
	/**
	 * Returns the password's hash.
	 */
	public function getPasswordHash() {
		return $this->passwordHash;
	}
	
	/**
	 * Returns the salt.
	 */
	public function getSalt() {
		return $this->salt;
	}
	
	/**
	 * Returns the user role.
	 */
	public function getUserRole() {
		return $this->userRole;
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
	 * Sets the creator.
	 * 
	 * Receives the user to be set.
	 */
	public function setCreator($user) {
		$this->creator = $user;
	}
	
	/**
	 * Sets the email address.
	 * 
	 * Receives the email address to be set.
	 */
	public function setEmailAddress($emailAddress) {
		$this->emailAddress = $emailAddress;
	}
	
	/**
	 * Sets the key-stretching iterations.
	 * 
	 * Receives the iterations to be set.
	 */
	public function setKeyStretchingIterations($iterations) {
		$this->keyStretchingIterations = $iterations;
	}
	
	/**
	 * Sets the password's hash.
	 * 
	 * Receives the hash to be set.
	 */
	public function setPasswordHash($hash) {
		$this->passwordHash = $hash;
	}
	
	/**
	 * Sets the salt.
	 * 
	 * Receives the salt to be set.
	 */
	public function setSalt($salt) {
		$this->salt = $salt;
	}
	
	/**
	 * Sets the user role.
	 * 
	 * Receives the user role to be set.
	 */
	public function setUserRole($userRole) {
		$this->userRole = $userRole;
	}
	
}
