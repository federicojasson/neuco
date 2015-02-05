<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers an interface to perform operations on backgrounds.
 */
class BackgroundModel extends EntityModel {
	
	/*
	 * Creates an entity of the type of this model.
	 * 
	 * It receives the entity's data.
	 */
	public function create() {
		$app = $this->app;
		
		// Creates the background
		$function = [ $app->businessLogicDatabase, 'createBackground' ];
		call_user_func_array($function, func_get_args());
	}
	
	/*
	 * Deletes an entity of the type of this model.
	 * 
	 * It receives the entity's ID.
	 */
	public function delete($id) {
		// The operation is not defined
	}
	
	/*
	 * Edits an entity of the type of this model.
	 * 
	 * It receives the entity's data.
	 */
	public function edit() {
		// The operation is not defined
	}
	
	/*
	 * Determines whether an entity exists.
	 * 
	 * It receives the entity's ID.
	 */
	public function exists($id) {
		// The operation is not defined
		return false;
	}
	
	/*
	 * Filters an entity for presentation and returns the result.
	 * 
	 * It receives the entity.
	 */
	public function filter($entity) {
		// The operation is not defined
		return null;
	}
	
	/*
	 * Returns an entity of the type of this model. If it doesn't exist, null is
	 * returned.
	 * 
	 * It receives the entity's ID.
	 */
	public function get($id) {
		// The operation is not defined
		return null;
	}
	
	/*
	 * Searches entities of the type of this model and returns the results.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function search($expression, $page, $sorting) {
		// The operation is not defined
		return null;
	}
	
}
