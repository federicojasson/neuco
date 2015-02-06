<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers an interface to perform operations on neurocognitive tests.
 */
class NeurocognitiveTestModel extends EntityModel {
	
	/*
	 * Creates an entity of the type of this model.
	 * 
	 * It receives the entity's data.
	 */
	public function create() {
		$app = $this->app;
		
		// Creates the neurocognitive test
		$function = [ $app->businessLogicDatabase, 'createNeurocognitiveTest' ];
		call_user_func_array($function, func_get_args());
	}
	
	/*
	 * Deletes an entity of the type of this model.
	 * 
	 * It receives the entity's ID.
	 */
	public function delete($id) {
		$app = $this->app;
		
		// Deletes the neurocognitive test
		$app->businessLogicDatabase->deleteNeurocognitiveTest($id);
	}
	
	/*
	 * Edits an entity of the type of this model.
	 * 
	 * It receives the entity's data.
	 */
	public function edit() {
		$app = $this->app;
		
		// Edits the neurocognitive test
		$function = [ $app->businessLogicDatabase, 'editNeurocognitiveTest' ];
		call_user_func_array($function, func_get_args());
	}
	
	/*
	 * Determines whether an entity exists.
	 * 
	 * It receives the entity's ID.
	 */
	public function exists($id) {
		$app = $this->app;
		
		// Determines whether the neurocognitive test exists
		return $app->businessLogicDatabase->nonDeletedNeurocognitiveTestExists($id);
	}
	
	/*
	 * Filters an entity for presentation and returns the result.
	 * 
	 * It receives the entity.
	 */
	public function filter($entity) {
		// TODO: implement
		return $entity;
	}
	
	/*
	 * Returns an entity of the type of this model. If it doesn't exist, null is
	 * returned.
	 * 
	 * It receives the entity's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the neurocognitive test
		return $app->businessLogicDatabase->getNonDeletedNeurocognitiveTest($id);
	}
	
	/*
	 * Searches entities of the type of this model. It returns an array
	 * containing, as the first element, the total number of results, and as the
	 * second, the results ready for presentation that were found in the page.
	 * 
	 * It receives an expression, the page and a sorting.
	 */
	public function search($expression, $page, $sorting) {
		$app = $this->app;
		
		if (is_null($expression)) {
			// Searches all neurocognitive tests
			$neurocognitiveTests = $app->businessLogicDatabase->searchAllNonDeletedNeurocognitiveTests($page, $sorting);
		} else {
			// Searches specific neurocognitive tests
			$neurocognitiveTests = $app->businessLogicDatabase->searchSpecificNonDeletedNeurocognitiveTests($expression, $page, $sorting);
		}
		
		// Gets the number of rows found
		$foundRows = $app->businessLogicDatabase->getFoundRows();
		
		// Gets the IDs
		$ids = array_column($neurocognitiveTests, 'id');
		
		// Converts the IDs to hexadecimal
		$ids = applyFunctionToArray($ids, 'bin2hex');
		
		return [ $foundRows, $ids ];
	}
	
}
