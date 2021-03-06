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
 * Represents a user from the database.
 * 
 * Annotations:
 * 
 * @Entity
 * @Table(name="users")
 * @HasLifecycleCallbacks
 */
class User {
	
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
	 * The first name.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="first_name",
	 *		type="string",
	 *		length=48,
	 *		nullable=false
	 *	)
	 */
	private $firstName;
	
	/**
	 * The gender.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="gender",
	 *		type="binary_data",
	 *		length=1,
	 *		nullable=false,
	 *		options={
	 *			"fixed": true
	 *		}
	 *	)
	 */
	private $gender;
	
	/**
	 * The ID.
	 * 
	 * Annotations:
	 * 
	 * @Id
	 * @Column(
	 *		name="id",
	 *		type="binary_data",
	 *		length=32,
	 *		nullable=false
	 *	)
	 */
	private $id;
	
	/**
	 * The inviter.
	 * 
	 * Annotations:
	 * 
	 * @ManyToOne(targetEntity="User")
	 * @JoinColumn(
	 *		name="inviter",
	 *		referencedColumnName="id",
	 *		onDelete="SET NULL"
	 *	)
	 */
	private $inviter;
	
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
	 * The last-edition date-time.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="last_edition_date_time",
	 *		type="datetime"
	 *	)
	 */
	private $lastEditionDateTime;
	
	/**
	 * The last name.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="last_name",
	 *		type="string",
	 *		length=48,
	 *		nullable=false
	 *	)
	 */
	private $lastName;
	
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
	 * The password-reset permission.
	 * 
	 * Annotations:
	 * 
	 * @OneToOne(
	 *		targetEntity="PasswordResetPermission",
	 *		mappedBy="user"
	 *	)
	 */
	private $passwordResetPermission;
	
	/**
	 * The role.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="role",
	 *		type="binary_data",
	 *		length=2,
	 *		nullable=false,
	 *		options={
	 *			"fixed": true
	 *		}
	 *	)
	 */
	private $role;
	
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
	 * The version.
	 * 
	 * Annotations:
	 * 
	 * @Version
	 * @Column(
	 *		name="version",
	 *		type="integer",
	 *		nullable=false,
	 *		options={
	 *			"unsigned": true
	 *		}
	 *	)
	 */
	private $version;
	
	/**
	 * Returns a string representation of the entity.
	 */
	public function __toString() {
		return $this->id;
	}
	
	/**
	 * Returns the email address.
	 */
	public function getEmailAddress() {
		return $this->emailAddress;
	}
	
	/**
	 * Returns the first name.
	 */
	public function getFirstName() {
		return $this->firstName;
	}
	
	/**
	 * Returns the ID.
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Returns the inviter.
	 */
	public function getInviter() {
		return $this->inviter;
	}
	
	/**
	 * Returns the key-stretching iterations.
	 */
	public function getKeyStretchingIterations() {
		return $this->keyStretchingIterations;
	}
	
	/**
	 * Returns the last name.
	 */
	public function getLastName() {
		return $this->lastName;
	}
	
	/**
	 * Returns the password's hash.
	 */
	public function getPasswordHash() {
		return $this->passwordHash;
	}
	
	/**
	 * Returns the password-reset permission.
	 */
	public function getPasswordResetPermission() {
		return $this->passwordResetPermission;
	}
	
	/**
	 * Returns the role.
	 */
	public function getRole() {
		return $this->role;
	}
	
	/**
	 * Returns the salt.
	 */
	public function getSalt() {
		return $this->salt;
	}
	
	/**
	 * Serializes the entity.
	 */
	public function serialize() {
		$serialized = [];
		
		// Adds the appropriate fields
		// The process only considers accessible fields and it filters them
		// according to their specific characteristics
		
		$serialized['id'] = $this->id;
		$serialized['version'] = $this->version;
		$serialized['creationDateTime'] = $this->creationDateTime->format(\DateTime::ISO8601);
		
		$serialized['lastEditionDateTime'] = null;
		if (! is_null($this->lastEditionDateTime)) {
			$serialized['lastEditionDateTime'] = $this->lastEditionDateTime->format(\DateTime::ISO8601);
		}
		
		$serialized['role'] = $this->role;
		$serialized['emailAddress'] = $this->emailAddress;
		$serialized['firstName'] = $this->firstName;
		$serialized['lastName'] = $this->lastName;
		$serialized['gender'] = $this->gender;
		
		$serialized['inviter'] = null;
		if (! is_null($this->getInviter())) {
			$serialized['inviter'] = (string) $this->getInviter();
		}
		
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
	 * Sets the email address.
	 * 
	 * Receives the email address to be set.
	 */
	public function setEmailAddress($emailAddress) {
		$this->emailAddress = $emailAddress;
	}
	
	/**
	 * Sets the first name.
	 * 
	 * Receives the first name to be set.
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}
	
	/**
	 * Sets the gender.
	 * 
	 * Receives the gender to be set.
	 */
	public function setGender($gender) {
		$this->gender = $gender;
	}
	
	/**
	 * Sets the ID.
	 * 
	 * Receives the ID to be set.
	 */
	public function setId($id) {
		$this->id = $id;
	}
	
	/**
	 * Sets the inviter.
	 * 
	 * Receives the user to be set.
	 */
	public function setInviter($user) {
		$this->inviter = $user;
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
	 * Sets the last-edition date-time.
	 */
	public function setLastEditionDateTime() {
		$this->lastEditionDateTime = new \DateTime();
	}
	
	/**
	 * Sets the last name.
	 * 
	 * Receives the last name to be set.
	 */
	public function setLastName($lastName) {
		$this->lastName = $lastName;
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
	 * Sets the role.
	 * 
	 * Receives the user role to be set.
	 */
	public function setRole($userRole) {
		$this->role = $userRole;
	}
	
	/**
	 * Sets the salt.
	 * 
	 * Receives the salt to be set.
	 */
	public function setSalt($salt) {
		$this->salt = $salt;
	}
	
}
