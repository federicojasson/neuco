<?php

namespace App\Helpers;

/*
 * This helper acts as a builder of Email objects.
 * 
 * The newEmail function should be used to reset its state before starting to
 * build an object.
 */
class EmailBuilder extends \App\Helpers\Helper {
	
	/*
	 * Keeps the state of the email being built.
	 */
	private $state;
	
	/*
	 * Builds and returns the email.
	 */
	public function build() {
		$state = $this->state;
		
		// Gets the basic information of the email
		$from = $state[EMAIL_BUILDER_PARAMETER_FROM];
		$to = $state[EMAIL_BUILDER_PARAMETER_TO];
		$subject = $state[EMAIL_BUILDER_PARAMETER_SUBJECT];
		$message = $state[EMAIL_BUILDER_PARAMETER_MESSAGE];
		
		// Initializes the additional headers
		$additionalHeaders = '';
		$additionalHeaders .= 'From: ' . $from . CRLF;
		// TODO: test and complete with additional headers
		
		// Creates and returns the email
		return new Email($to, $subject, $message, $additionalHeaders);
	}
	
	/*
	 * Sets the sender's email address and returns the builder.
	 * 
	 * It receives the email address of the sender.
	 */
	public function from($from) {
		$this->state[EMAIL_BUILDER_PARAMETER_FROM] = $from;
		
		return $this;
	}
	
	/*
	 * Sets the email's message and returns the builder.
	 * 
	 * It receives the message.
	 */
	public function message($message) {
		$this->state[EMAIL_BUILDER_PARAMETER_MESSAGE] = $message;
		
		return $this;
	}
	
	/*
	 * Resets the state of the builder in order to start creating a new email
	 * and returns the builder.
	 */
	public function newEmail() {
		$this->state = [];
		
		return $this;
	}
	
	/*
	 * Sets the email's subject and returns the builder.
	 * 
	 * It receives the subject.
	 */
	public function subject($subject) {
		$this->state[EMAIL_BUILDER_PARAMETER_SUBJECT] = $subject;
		
		return $this;
	}
	
	/*
	 * Sets the receiver's email address and returns the builder.
	 * 
	 * It receives the email address of the receiver.
	 */
	public function to($to) {
		$this->state[EMAIL_BUILDER_PARAMETER_TO] = $to;
		
		return $this;
	}
	
}
