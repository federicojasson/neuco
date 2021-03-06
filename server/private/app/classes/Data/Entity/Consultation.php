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
 * Represents a consultation from the database.
 * 
 * Annotations:
 * 
 * @Entity(repositoryClass="App\Data\EntityRepository\Custom")
 * @Table(name="consultations")
 * @HasLifecycleCallbacks
 */
class Consultation {
	
	/**
	 * The clinical impression.
	 * 
	 * Annotations:
	 * 
	 * @ManyToOne(targetEntity="ClinicalImpression")
	 * @JoinColumn(
	 *		name="clinical_impression",
	 *		referencedColumnName="id",
	 *		onDelete="SET NULL"
	 *	)
	 */
	private $clinicalImpression;
	
	/**
	 * The cognitive-test results.
	 * 
	 * Annotations:
	 * 
	 * @OneToMany(
	 *		targetEntity="CognitiveTestResult",
	 *		mappedBy="consultation",
	 *		orphanRemoval=true
	 *	)
	 */
	private $cognitiveTestResults;
	
	/**
	 * The comments.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="comments",
	 *		type="text",
	 *		nullable=false
	 *	)
	 */
	private $comments;
	
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
	 * The date.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="date",
	 *		type="date",
	 *		nullable=false
	 *	)
	 */
	private $date;
	
	/**
	 * Indicates whether the entity is deleted.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="deleted",
	 *		type="boolean",
	 *		nullable=false
	 *	)
	 */
	private $deleted;
	
	/**
	 * The deleter.
	 * 
	 * Annotations:
	 * 
	 * @ManyToOne(targetEntity="User")
	 * @JoinColumn(
	 *		name="deleter",
	 *		referencedColumnName="id",
	 *		onDelete="SET NULL"
	 *	)
	 */
	private $deleter;
	
	/**
	 * The deletion date-time.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="deletion_date_time",
	 *		type="datetime"
	 *	)
	 */
	private $deletionDateTime;
	
	/**
	 * The diagnosis.
	 * 
	 * Annotations:
	 * 
	 * @ManyToOne(targetEntity="Diagnosis")
	 * @JoinColumn(
	 *		name="diagnosis",
	 *		referencedColumnName="id",
	 *		onDelete="SET NULL"
	 *	)
	 */
	private $diagnosis;
	
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
	 * The imaging-test results.
	 * 
	 * Annotations:
	 * 
	 * @OneToMany(
	 *		targetEntity="ImagingTestResult",
	 *		mappedBy="consultation",
	 *		orphanRemoval=true
	 *	)
	 */
	private $imagingTestResults;
	
	/**
	 * The laboratory-test results.
	 * 
	 * Annotations:
	 * 
	 * @OneToMany(
	 *		targetEntity="LaboratoryTestResult",
	 *		mappedBy="consultation",
	 *		orphanRemoval=true
	 *	)
	 */
	private $laboratoryTestResults;
	
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
	 * The last editor.
	 * 
	 * Annotations:
	 * 
	 * @ManyToOne(targetEntity="User")
	 * @JoinColumn(
	 *		name="last_editor",
	 *		referencedColumnName="id",
	 *		onDelete="SET NULL"
	 *	)
	 */
	private $lastEditor;
	
	/**
	 * The medical antecedents.
	 * 
	 * Annotations:
	 * 
	 * @ManyToMany(targetEntity="MedicalAntecedent")
	 * @JoinTable(
	 *		name="consultations_medical_antecedents",
	 *		joinColumns={
	 *			@JoinColumn(
	 *				name="consultation",
	 *				referencedColumnName="id",
	 *				nullable=false,
	 *				onDelete="RESTRICT"
	 *			)
	 *		},
	 *		inverseJoinColumns={
	 *			@JoinColumn(
	 *				name="medical_antecedent",
	 *				referencedColumnName="id",
	 *				nullable=false,
	 *				onDelete="RESTRICT"
	 *			)
	 *		}
	 *	)
	 */
	private $medicalAntecedents;
	
	/**
	 * The medicines.
	 * 
	 * Annotations:
	 * 
	 * @ManyToMany(targetEntity="Medicine")
	 * @JoinTable(
	 *		name="consultations_medicines",
	 *		joinColumns={
	 *			@JoinColumn(
	 *				name="consultation",
	 *				referencedColumnName="id",
	 *				nullable=false,
	 *				onDelete="RESTRICT"
	 *			)
	 *		},
	 *		inverseJoinColumns={
	 *			@JoinColumn(
	 *				name="medicine",
	 *				referencedColumnName="id",
	 *				nullable=false,
	 *				onDelete="RESTRICT"
	 *			)
	 *		}
	 *	)
	 */
	private $medicines;
	
	/**
	 * The patient.
	 * 
	 * Annotations:
	 * 
	 * @ManyToOne(
	 *		targetEntity="Patient",
	 *		inversedBy="consultations"
	 *	)
	 * @JoinColumn(
	 *		name="patient",
	 *		referencedColumnName="id",
	 *		nullable=false,
	 *		onDelete="RESTRICT"
	 *	)
	 */
	private $patient;
	
	/**
	 * The patient's impression.
	 * 
	 * @Column(
	 *		name="patient_impression",
	 *		type="string",
	 *		length=256,
	 *		nullable=false
	 *	)
	 */
	private $patientImpression;
	
	/**
	 * The presenting problem.
	 * 
	 * Annotations:
	 * 
	 * @Column(
	 *		name="presenting_problem",
	 *		type="text",
	 *		nullable=false
	 *	)
	 */
	private $presentingProblem;
	
	/**
	 * The studies.
	 * 
	 * Annotations:
	 * 
	 * @OneToMany(
	 *		targetEntity="Study",
	 *		mappedBy="consultation"
	 *	)
	 * @OrderBy({
	 *		"creationDateTime"="ASC"
	 *	})
	 */
	private $studies;
	
	/**
	 * The treatments.
	 * 
	 * Annotations:
	 * 
	 * @ManyToMany(targetEntity="Treatment")
	 * @JoinTable(
	 *		name="consultations_treatments",
	 *		joinColumns={
	 *			@JoinColumn(
	 *				name="consultation",
	 *				referencedColumnName="id",
	 *				nullable=false,
	 *				onDelete="RESTRICT"
	 *			)
	 *		},
	 *		inverseJoinColumns={
	 *			@JoinColumn(
	 *				name="treatment",
	 *				referencedColumnName="id",
	 *				nullable=false,
	 *				onDelete="RESTRICT"
	 *			)
	 *		}
	 *	)
	 */
	private $treatments;
	
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
	 * Initializes an instance of the class.
	 */
	public function __construct() {
		$this->deleted = false;
		$this->medicalAntecedents = new \Doctrine\Common\Collections\ArrayCollection();
		$this->medicines = new \Doctrine\Common\Collections\ArrayCollection();
		$this->laboratoryTestResults = new \Doctrine\Common\Collections\ArrayCollection();
		$this->imagingTestResults = new \Doctrine\Common\Collections\ArrayCollection();
		$this->cognitiveTestResults = new \Doctrine\Common\Collections\ArrayCollection();
		$this->treatments = new \Doctrine\Common\Collections\ArrayCollection();
	}
	
	/**
	 * Returns a string representation of the entity.
	 */
	public function __toString() {
		return bin2hex($this->id);
	}
	
	/**
	 * Adds a cognitive-test result.
	 * 
	 * Receives the cognitive-test result to be added.
	 */
	public function addCognitiveTestResult($cognitiveTestResult) {
		$this->cognitiveTestResults->add($cognitiveTestResult);
	}
	
	/**
	 * Adds an imaging-test result.
	 * 
	 * Receives the imaging-test result to be added.
	 */
	public function addImagingTestResult($imagingTestResult) {
		$this->imagingTestResults->add($imagingTestResult);
	}
	
	/**
	 * Adds a laboratory-test result.
	 * 
	 * Receives the laboratory-test result to be added.
	 */
	public function addLaboratoryTestResult($laboratoryTestResult) {
		$this->laboratoryTestResults->add($laboratoryTestResult);
	}
	
	/**
	 * Adds a medical antecedent.
	 * 
	 * Receives the medical antecedent to be added.
	 */
	public function addMedicalAntecedent($medicalAntecedent) {
		$this->medicalAntecedents->add($medicalAntecedent);
	}
	
	/**
	 * Adds a medicine.
	 * 
	 * Receives the medicine to be added.
	 */
	public function addMedicine($medicine) {
		$this->medicines->add($medicine);
	}
	
	/**
	 * Adds a treatment.
	 * 
	 * Receives the treatment to be added.
	 */
	public function addTreatment($treatment) {
		$this->treatments->add($treatment);
	}
	
	/**
	 * Deletes the entity.
	 * 
	 * Receives the user to be set as the deleter.
	 */
	public function delete($user) {
		$this->deletionDateTime = new \DateTime();
		$this->deleted = true;
		$this->deleter = $user;
		
		// Deletes the appropriate associated entities
		// The process only considers entities that have not been deleted yet
		
		foreach ($this->getStudies() as $study) {
			$study->delete($user);
		}
	}
	
	/**
	 * Returns the clinical impression.
	 */
	public function getClinicalImpression() {
		if (is_null($this->clinicalImpression)) {
			return null;
		}
		
		if ($this->clinicalImpression->isDeleted()) {
			return null;
		}
		
		return $this->clinicalImpression;
	}
	
	/**
	 * Returns the cognitive-test results.
	 */
	public function getCognitiveTestResults() {
		$cognitiveTestResults = [];
		
		foreach ($this->cognitiveTestResults as $cognitiveTestResult) {
			$cognitiveTest = $cognitiveTestResult->getCognitiveTest();
			
			if (! is_null($cognitiveTest)) {
				$cognitiveTestResults[] = $cognitiveTestResult;
			}
		}
		
		return $cognitiveTestResults;
	}
	
	/**
	 * Returns the creator.
	 */
	public function getCreator() {
		return $this->creator;
	}
	
	/**
	 * Returns the diagnosis.
	 */
	public function getDiagnosis() {
		if (is_null($this->diagnosis)) {
			return null;
		}
		
		if ($this->diagnosis->isDeleted()) {
			return null;
		}
		
		return $this->diagnosis;
	}
	
	/**
	 * Returns the ID.
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Returns the imaging-test results.
	 */
	public function getImagingTestResults() {
		$imagingTestResults = [];
		
		foreach ($this->imagingTestResults as $imagingTestResult) {
			$imagingTest = $imagingTestResult->getImagingTest();
			
			if (! is_null($imagingTest)) {
				$imagingTestResults[] = $imagingTestResult;
			}
		}
		
		return $imagingTestResults;
	}
	
	/**
	 * Returns the laboratory-test results.
	 */
	public function getLaboratoryTestResults() {
		$laboratoryTestResults = [];
		
		foreach ($this->laboratoryTestResults as $laboratoryTestResult) {
			$laboratoryTest = $laboratoryTestResult->getLaboratoryTest();
			
			if (! is_null($laboratoryTest)) {
				$laboratoryTestResults[] = $laboratoryTestResult;
			}
		}
		
		return $laboratoryTestResults;
	}
	
	/**
	 * Returns the last editor.
	 */
	public function getLastEditor() {
		return $this->lastEditor;
	}
	
	/**
	 * Returns the medical antecedents.
	 */
	public function getMedicalAntecedents() {
		$medicalAntecedents = [];
		
		foreach ($this->medicalAntecedents as $medicalAntecedent) {
			if (! $medicalAntecedent->isDeleted()) {
				$medicalAntecedents[] = $medicalAntecedent;
			}
		}
		
		return $medicalAntecedents;
	}
	
	/**
	 * Returns the medicines.
	 */
	public function getMedicines() {
		$medicines = [];
		
		foreach ($this->medicines as $medicine) {
			if (! $medicine->isDeleted()) {
				$medicines[] = $medicine;
			}
		}
		
		return $medicines;
	}
	
	/**
	 * Returns the patient.
	 */
	public function getPatient() {
		return $this->patient;
	}
	
	/**
	 * Returns the studies.
	 */
	public function getStudies() {
		$studies = [];
		
		foreach ($this->studies as $study) {
			if (! $study->isDeleted()) {
				$studies[] = $study;
			}
		}
		
		return $studies;
	}
	
	/**
	 * Returns the treatments.
	 */
	public function getTreatments() {
		$treatments = [];
		
		foreach ($this->treatments as $treatment) {
			if (! $treatment->isDeleted()) {
				$treatments[] = $treatment;
			}
		}
		
		return $treatments;
	}
	
	/**
	 * Determines whether the entity is deleted.
	 */
	public function isDeleted() {
		return $this->deleted;
	}
	
	/**
	 * Removes a cognitive-test result.
	 * 
	 * Receives the cognitive-test result to be removed.
	 */
	public function removeCognitiveTestResult($cognitiveTestResult) {
		$this->cognitiveTestResults->removeElement($cognitiveTestResult);
	}
	
	/**
	 * Removes an imaging-test result.
	 * 
	 * Receives the imaging-test result to be removed.
	 */
	public function removeImagingTestResult($imagingTestResult) {
		$this->imagingTestResults->removeElement($imagingTestResult);
	}
	
	/**
	 * Removes a laboratory-test result.
	 * 
	 * Receives the laboratory-test result to be removed.
	 */
	public function removeLaboratoryTestResult($laboratoryTestResult) {
		$this->laboratoryTestResults->removeElement($laboratoryTestResult);
	}
	
	/**
	 * Removes a medical antecedent.
	 * 
	 * Receives the medical antecedent to be removed.
	 */
	public function removeMedicalAntecedent($medicalAntecedent) {
		$this->medicalAntecedents->removeElement($medicalAntecedent);
	}
	
	/**
	 * Removes a medicine.
	 * 
	 * Receives the medicine to be removed.
	 */
	public function removeMedicine($medicine) {
		$this->medicines->removeElement($medicine);
	}
	
	/**
	 * Removes a treatment.
	 * 
	 * Receives the treatment to be removed.
	 */
	public function removeTreatment($treatment) {
		$this->treatments->removeElement($treatment);
	}
	
	/**
	 * Serializes the entity.
	 */
	public function serialize() {
		$serialized = [];
		
		// Adds the appropriate fields
		// The process only considers accessible fields and it filters them
		// according to their specific characteristics
		
		$serialized['id'] = bin2hex($this->id);
		$serialized['version'] = $this->version;
		$serialized['creationDateTime'] = $this->creationDateTime->format(\DateTime::ISO8601);
		
		$serialized['lastEditionDateTime'] = null;
		if (! is_null($this->lastEditionDateTime)) {
			$serialized['lastEditionDateTime'] = $this->lastEditionDateTime->format(\DateTime::ISO8601);
		}
		
		$serialized['date'] = $this->date->format('Y-m-d');
		$serialized['patientImpression'] = $this->patientImpression;
		$serialized['presentingProblem'] = $this->presentingProblem;
		$serialized['comments'] = $this->comments;
		
		$serialized['creator'] = null;
		if (! is_null($this->getCreator())) {
			$serialized['creator'] = (string) $this->getCreator();
		}
		
		$serialized['lastEditor'] = null;
		if (! is_null($this->getLastEditor())) {
			$serialized['lastEditor'] = (string) $this->getLastEditor();
		}
		
		$serialized['patient'] = (string) $this->getPatient();
		
		$serialized['clinicalImpression'] = null;
		if (! is_null($this->getClinicalImpression())) {
			$serialized['clinicalImpression'] = (string) $this->getClinicalImpression();
		}
		
		$serialized['diagnosis'] = null;
		if (! is_null($this->getDiagnosis())) {
			$serialized['diagnosis'] = (string) $this->getDiagnosis();
		}
		
		$serialized['medicalAntecedents'] = filterArray($this->getMedicalAntecedents(), 'toString');
		$serialized['medicines'] = filterArray($this->getMedicines(), 'toString');
		
		$serialized['laboratoryTestResults'] = filterArray($this->getLaboratoryTestResults(), function($laboratoryTestResult) {
			return [
				'laboratoryTest' => (string) $laboratoryTestResult->getLaboratoryTest(),
				'value' => \App\InputValidator\DataType\Factory::parseValue($laboratoryTestResult->getLaboratoryTest()->getDataTypeDefinition(), $laboratoryTestResult->getValue())
			];
		});
		
		$serialized['imagingTestResults'] = filterArray($this->getImagingTestResults(), function($imagingTestResult) {
			return [
				'imagingTest' => (string) $imagingTestResult->getImagingTest(),
				'value' => \App\InputValidator\DataType\Factory::parseValue($imagingTestResult->getImagingTest()->getDataTypeDefinition(), $imagingTestResult->getValue())
			];
		});
		
		$serialized['cognitiveTestResults'] = filterArray($this->getCognitiveTestResults(), function($cognitiveTestResult) {
			return [
				'cognitiveTest' => (string) $cognitiveTestResult->getCognitiveTest(),
				'value' => \App\InputValidator\DataType\Factory::parseValue($cognitiveTestResult->getCognitiveTest()->getDataTypeDefinition(), $cognitiveTestResult->getValue())
			];
		});
		
		$serialized['treatments'] = filterArray($this->getTreatments(), 'toString');
		$serialized['studies'] = filterArray($this->getStudies(), 'toString');
		
		return $serialized;
	}
	
	/**
	 * Sets the clinical impression.
	 * 
	 * Receives the clinical impression to be set.
	 */
	public function setClinicalImpression($clinicalImpression) {
		$this->clinicalImpression = $clinicalImpression;
	}
	
	/**
	 * Sets the comments.
	 * 
	 * Receives the comments to be set.
	 */
	public function setComments($comments) {
		$this->comments = $comments;
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
	 * Sets the date.
	 * 
	 * Receives the date to be set.
	 */
	public function setDate($date) {
		$this->date = $date;
	}
	
	/**
	 * Sets the diagnosis.
	 * 
	 * Receives the diagnosis to be set.
	 */
	public function setDiagnosis($diagnosis) {
		$this->diagnosis = $diagnosis;
	}
	
	/**
	 * Sets the last-edition date-time.
	 */
	public function setLastEditionDateTime() {
		$this->lastEditionDateTime = new \DateTime();
	}
	
	/**
	 * Sets the last editor.
	 * 
	 * Receives the user to be set.
	 */
	public function setLastEditor($user) {
		$this->lastEditor = $user;
	}
	
	/**
	 * Sets the patient.
	 * 
	 * Receives the patient to be set.
	 */
	public function setPatient($patient) {
		$this->patient = $patient;
	}
	
	/**
	 * Sets the patient's impression.
	 * 
	 * Receives the impression to be set.
	 */
	public function setPatientImpression($impression) {
		$this->patientImpression = $impression;
	}
	
	/**
	 * Sets the presenting problem.
	 * 
	 * Receives the presenting problem to be set.
	 */
	public function setPresentingProblem($presentingProblem) {
		$this->presentingProblem = $presentingProblem;
	}
	
}
