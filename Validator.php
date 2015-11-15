<?php

/*
This class validates our Components form. It utilizes a Strategy Design Pattern to allow greater flexibility.
*/


class Validator {
	
	private $_validateBehavior, $_data, $_errors;


	/*
	The construct takes a String argument ('component' || 'template') and selects the appropriate validation behavior
	which is further specified in the ValidateComponent, ValidateTemplate classes.

	$data has to be the entire unmodified POST array sent to the page.

	$errors is an errors array to which the validator class will append all of the errors.
	*/
	public function __construct($validate_type, $data) {
		switch ($validate_type) {
			case 'component':
				$this->_validateBehavior = new ValidateComponent($data);
				break;
			case 'template':
				$this->_validateBehavior = new ValidateTemplate($data);
				break;
		}
		$this->_data = $data;

		$this->validate();
	}

	public function errors() {
		return $this->_errors;
	}

	private function validate(){
		$this->_errors = $this->_validateBehavior->validate($this->_data);
	}

}